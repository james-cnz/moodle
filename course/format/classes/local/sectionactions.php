<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

namespace core_courseformat\local;

use section_info;
use stdClass;
use core\event\course_module_updated;
use core\event\course_section_deleted;

/**
 * Section course format actions.
 *
 * @package    core_courseformat
 * @copyright  2023 Ferran Recio <ferran@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class sectionactions extends baseactions {
    /**
     * Create a course section using a record object.
     *
     * If $fields->section is not set, the section is added to the end of the course.
     *
     * @param stdClass $fields the fields to set on the section
     * @param bool $skipcheck the position check has already been made and we know it can be used
     * @return stdClass the created section record
     */
    protected function create_from_object(stdClass $fields, bool $skipcheck = false): stdClass {
        global $DB;

        $skipcheck = $skipcheck && isset($fields->section);

        // Determine the create position, and adapt fields for the move method, if necessary.
        if ($skipcheck) {
            $createnum = $fields->section;
        } else {
            $createnum = $DB->get_field_sql(
                'SELECT max(section) from {course_sections} WHERE course = ?',
                [$this->course->id]
            ) + 1;
            if ((!isset($fields->section) || $fields->section > $createnum) && !isset($fields->nextid)) {
                unset($fields->section);
                $fields->nextid = null;
            }
        }

        // First add section to the end.
        $sectionrecord = (object) [
            'course' => $this->course->id,
            'section' => $createnum,
            'summary' => $fields->summary ?? '',
            'summaryformat' => $fields->summaryformat ?? FORMAT_HTML,
            'sequence' => '',
            'name' => $fields->name ?? null,
            'visible' => $fields->visible ?? 1,
            'availability' => $fields->availability ?? null,
            'component' => $fields->component ?? null,
            'itemid' => $fields->itemid ?? null,
            'timemodified' => time(),
        ];
        $sectionrecord->id = $DB->insert_record("course_sections", $sectionrecord);

        // Now move it to the specified position, if necessary.
        if (!$skipcheck && !(!empty($fields->component) && property_exists($fields, 'nextid') && $fields->nextid == null)) {
            try {
                $movednews = $this->move_sections_to([$sectionrecord], $fields, !empty($fields->component) ? 2 : 1);
                $sectionrecord->section = $movednews[$sectionrecord->id]->section;
            } catch (\moodle_exception $e) {
                $DB->delete_records('course_sections', [$id => $sectionrecord->id]);
                throw $e;
            }
        }

        \core\event\course_section_created::create_from_section($sectionrecord)->trigger();

        rebuild_course_cache($this->course->id, true);
        return $sectionrecord;
    }

    /**
     * Get the last section number in the course.
     * @param bool $includedelegated whether to include delegated sections
     * @return int
     */
    protected function get_last_section_number(bool $includedelegated = true): int {
        global $DB;

        $delegtadefilter = $includedelegated ? '' : ' AND component IS NULL';

        return (int) $DB->get_field_sql(
            'SELECT max(section) from {course_sections} WHERE course = ?' . $delegtadefilter,
            [$this->course->id]
        );
    }

    /**
     * Create a delegated section.
     *
     * @param string $component the name of the plugin
     * @param int|null $itemid the id of the delegated section
     * @param stdClass|null $fields the fields to set on the section
     * @return section_info the created section
     */
    public function create_delegated(
        string $component,
        ?int $itemid = null,
        ?stdClass $fields = null
    ): section_info {
        $record = ($fields) ? clone $fields : new stdClass();
        $record->component = $component;
        $record->itemid = $itemid;

        $record = $this->create_from_object($record);
        return $this->get_section_info($record->id);
    }

    /**
     * Creates a course section and adds it to the specified position
     *
     * This method returns a section record, not a section_info object. This prevents the regeneration
     * of the modinfo object each time we create a section.
     *
     * If position is greater than number of existing sections, the section is added to the end.
     * This will become sectionnum of the new section. All existing sections at this or bigger
     * position will be shifted down.
     *
     * @param int $position the position to add to, 0 means to the end.
     * @param bool $skipcheck the check has already been made and we know that the section with this position does not exist
     * @return stdClass created section object
     */
    public function create(int $position = 0, bool $skipcheck = false): stdClass {
        $record = (object) [
            'section' => ($position == 0 && !$skipcheck) ? null : $position,
        ];
        return $this->create_from_object($record, $skipcheck);
    }

    /**
     * Create course sections if they are not created yet.
     *
     * The calculations will ignore sections delegated to components.
     * If the section is created, all delegated sections will be pushed down.
     *
     * @param int[] $sectionnums the section numbers to create
     * @return bool whether any section was created
     */
    public function create_if_missing(array $sectionnums): bool {
        $result = false;
        $modinfo = get_fast_modinfo($this->course);
        // Ensure we add the sections in order.
        sort($sectionnums);
        // Delegated sections must be displaced when creating a regular section.
        $skipcheck = !$modinfo->has_delegated_sections();

        $sections = $modinfo->get_section_info_all();
        foreach ($sectionnums as $sectionnum) {
            if (isset($sections[$sectionnum]) && empty($sections[$sectionnum]->component)) {
                continue;
            }
            $this->create($sectionnum, $skipcheck);
            $result = true;
        }
        return $result;
    }

    /**
     * Moves sections within a course.
     *
     * @param object[] $origins  the origin section(s) to be moved
     *      Given as an array of objects with section ID or number.
     * @param \stdClass $destination  the new location for the origin section(s)
     *      Given as an object with previd, nextid, or section number.  Use nextid of null for end of course.
     * @param int $include  What types of sections are included in the move?
     *      0 regular only, 1 also orphan, 2 also delegated
     *      Specifies whether moved sections should be within numsections (0), within non-delegated (1), or not checked (2).
     *      Use in combination with nextid of null to move to the end of non-delegated (1) or all sections (2).
     * @return object[]  objects containing section numbers for the moved section(s), indexed by id
     */
    public function move_sections_to(array $origins, \stdClass $destination, int $include = 0): array {
        global $DB;

        // Get all sections for this course and re-order them.
        $sections = $DB->get_records('course_sections', ['course' => $this->course->id], 'section', 'id, section, component');
        if (!$sections) {
            throw new \moodle_exception('cannotcreateorfindstructs');
        }
        $movedsections = $this->reorder_sections($sections, $origins, $destination, $include);

        try {
            $transaction = $DB->start_delegated_transaction();

            // Update all sections. Do this in 2 steps to avoid breaking database
            // uniqueness constraint.
            foreach ($movedsections as $id => $movedsection) {
                if ((int) $sections[$id]->section != $movedsection->section) {
                    $DB->set_field('course_sections', 'section', -$movedsection->section, ['id' => $id]);
                }
            }
            foreach ($movedsections as $id => $movedsection) {
                if ((int) $sections[$id]->section != $movedsection->section) {
                    $DB->set_field('course_sections', 'section', $movedsection->section, ['id' => $id]);
                    // Invalidate the section cache by given section id.
                    \course_modinfo::purge_course_section_cache_by_id($this->course->id, $id);
                }
            }

            // Adjust the higlighted section location if necessary.
            $markernum = $DB->get_field('course', 'marker', ['id' => $this->course->id]);
            $markerid = null;
            foreach ($sections as $section) {
                if ($section->section == $markernum) {
                    $markerid = $section->id;
                    break;
                }
            }
            if ($markerid && $movedsections[$markerid]->section != $sections[$markerid]->section) {
                course_set_marker($this->course->id, $movedsections[$markerid]->section);
            }

            $transaction->allow_commit();
        } catch (\Exception $e) {
            if ($transaction) {
                $transaction->rollback($e);
            }
            throw $e;
        }

        rebuild_course_cache($this->course->id, true, true);

        // Provide new section numbers for moved sections.
        $movedorigins = [];
        foreach ($origins as $origin) {
            if (isset($origin->id)) {
                $originid = $origin->id;
            } else {
                foreach ($sections as $section) {
                    if ($section->section == $origin->section) {
                        $originid = $section->id;
                        break;
                    }
                }
            }
            $movedorigins[$originid] = (object)['id' => $originid, 'section' => $movedsections[$originid]->section];
        }

        return $movedorigins;

    }

    /**
     * Reordering algorithm for course sections. Given an array of sections indexed by section->id,
     * origin sections and a destination, rebuilds the array so that the
     * move is made without any duplication of section positions.
     *
     * @param object[] $sections  array of sections indexed by id
     *      Must include id, section, and component fields.
     * @param object[] $origins  the origin section(s) to be moved
     *      Given as an array of objects with section number or ID.
     * @param \stdClass $destination  the new location for the origin section(s)
     *      Given as an object with previd, nextid, or section number.  Use nextid of null for end of course.
     * @param int $include  What types of sections are included in the move?
     *      0 regular only, 1 also orphan, 2 also delegated
     * @return object[]
     */
    protected function reorder_sections(array $sections, array $origins, \stdClass $destination, int $include): array {

        // Ignore delegated sections if appropriate.
        $ignoredsections = [];
        if ($include < 2) {
            foreach ($sections as $id => $section) {
                if (!empty($section->component)) {
                    $ignoredsections[$id] = $section;
                    unset($sections[$id]);
                }
            }
        }

        // Locate and extract origin sections.
        $originsections = [];
        foreach ($origins as $origin) {

            // Locate origin section in sections array.
            $originsection = null;
            if (isset($origin->id)) {
                $originsection = $sections[$origin->id] ?? null;
            } else if (isset($origin->section)) {
                foreach ($sections as $id => $section) {
                    if ($section->section == $origin->section) {
                        $originsection = $section;
                        break;
                    }
                }
            }
            if (!$originsection) {
                throw new \moodle_exception('sectionnotexist');
            }

            // We can't move section position 0.
            if ($originsection->section <= 0) {
                throw new \moodle_exception('Cannot move section number 0.');
            }

            // Extract origin section.
            $originsections[$originsection->id] = $originsection;
            unset($sections[$originsection->id]);

        }

        // Find offset of target position and extract following sections.
        $found = false;
        $followingsections = [];
        $newposition = 0;
        foreach ($sections as $id => $section) {
            if ($found) {
                $followingsections[$id] = $section;
                unset($sections[$id]);
            } else if (
                isset($destination->nextid) && $id == $destination->nextid
                || isset($destination->section) && $newposition == $destination->section
            ) {
                $found = true;
                $followingsections[$id] = $section;
                unset($sections[$id]);
            } else if (isset($destination->previd) && $id == $destination->previd) {
                $found = true;
            }
            $newposition++;
        }
        if (
            !$found &&
            (property_exists($destination, 'nextid') && $destination->nextid == null
            || isset($destination->section) && $newposition == $destination->section)
        ) {
            $found = true;
        }

        if (!$found) {
            throw new \moodle_exception('sectionnotexist');
        }
        if (count($sections) == 0) {
            throw new \moodle_exception('Cannot move section number 0.');
        }

        // Compatibility with course formats using field 'numsections'.
        if ($include < 1) {
            $courseformatoptions = course_get_format($this->course)->get_format_options();
            $numsections = $courseformatoptions['numsections'] ?? PHP_INT_MAX;
            if (count($sections) + count($originsections) > $numsections) {
                throw new \moodle_exception('Moved sections would be outside numsections.');
            }
        }

        // Append moved sections.
        foreach ($originsections as $id => $section) {
            $sections[$id] = $section;
        }

        // Append following sections.
        foreach ($followingsections as $id => $section) {
            $sections[$id] = $section;
        }

        // Append ignored sections.
        foreach ($ignoredsections as $id => $section) {
            $sections[$id] = $section;
        }

        // Renumber positions.
        $position = 0;
        foreach ($sections as $id => $section) {
            $sections[$id] = clone($section);
            $sections[$id]->section = $position;
            $position++;
        }

        return $sections;

    }

    /**
     * Delete a course section.
     * @param section_info $sectioninfo the section to delete.
     * @param bool $forcedeleteifnotempty whether to force section deletion if it contains modules.
     * @param bool $async whether or not to try to delete the section using an adhoc task. Async also depends on a plugin hook.
     * @return bool whether section was deleted
     */
    public function delete(section_info $sectioninfo, bool $forcedeleteifnotempty = true, bool $async = false): bool {
        // Check the 'course_module_background_deletion_recommended' hook first.
        // Only use asynchronous deletion if at least one plugin returns true and if async deletion has been requested.
        // Both are checked because plugins should not be allowed to dictate the deletion behaviour, only support/decline it.
        // It's up to plugins to handle things like whether or not they are enabled.
        if ($async && $pluginsfunction = get_plugins_with_function('course_module_background_deletion_recommended')) {
            foreach ($pluginsfunction as $plugintype => $plugins) {
                foreach ($plugins as $pluginfunction) {
                    if ($pluginfunction()) {
                        return $this->delete_async($sectioninfo, $forcedeleteifnotempty);
                    }
                }
            }
        }

        return $this->delete_format_data(
            $sectioninfo,
            $forcedeleteifnotempty,
            $this->get_delete_event($sectioninfo)
        );
    }

    /**
     * Get the event to trigger when deleting a section.
     * @param section_info $sectioninfo the section to delete.
     * @return course_section_deleted the event to trigger
     */
    protected function get_delete_event(section_info $sectioninfo): course_section_deleted {
        global $DB;
        // Section record is needed for the event snapshot.
        $sectionrecord = $DB->get_record('course_sections', ['id' => $sectioninfo->id]);

        $format = course_get_format($this->course);
        $sectionname = $format->get_section_name($sectioninfo);
        $context = \context_course::instance($this->course->id);
        $event = course_section_deleted::create(
            [
                'objectid' => $sectioninfo->id,
                'courseid' => $this->course->id,
                'context' => $context,
                'other' => [
                    'sectionnum' => $sectioninfo->section,
                    'sectionname' => $sectionname,
                ],
            ]
        );
        $event->add_record_snapshot('course_sections', $sectionrecord);
        return $event;
    }

    /**
     * Delete a course section.
     * @param section_info $sectioninfo the section to delete.
     * @param bool $forcedeleteifnotempty whether to force section deletion if it contains modules.
     * @param course_section_deleted $event the event to trigger
     * @return bool whether section was deleted
     */
    protected function delete_format_data(
        section_info $sectioninfo,
        bool $forcedeleteifnotempty,
        course_section_deleted $event
    ): bool {
        $format = course_get_format($this->course);
        $result = $format->delete_section($sectioninfo, $forcedeleteifnotempty);
        if ($result) {
            $event->trigger();
        }
        rebuild_course_cache($this->course->id, true);
        return $result;
    }



    /**
     * Course section deletion, using an adhoc task for deletion of the modules it contains.
     * 1. Schedule all modules within the section for adhoc removal.
     * 2. Move all modules to course section 0.
     * 3. Delete the resulting empty section.
     *
     * @param section_info $sectioninfo the section to schedule for deletion.
     * @param bool $forcedeleteifnotempty whether to force section deletion if it contains modules.
     * @return bool true if the section was scheduled for deletion, false otherwise.
     */
    protected function delete_async(section_info $sectioninfo, bool $forcedeleteifnotempty = true): bool {
        global $DB, $USER;

        if (!$forcedeleteifnotempty && (!empty($sectioninfo->sequence) || !empty($sectioninfo->summary))) {
            return false;
        }

        // Event needs to be created before the section activities are moved to section 0.
        $event = $this->get_delete_event($sectioninfo);

        $affectedmods = $DB->get_records_select(
            'course_modules',
            'course = ? AND section = ? AND deletioninprogress <> ?',
            [$this->course->id, $sectioninfo->id, 1],
            '',
            'id'
        );

        // Flag those modules having no existing deletion flag. Some modules may have been
        // scheduled for deletion manually, and we don't want to create additional adhoc deletion
        // tasks for these. Moving them to section 0 will suffice.
        $DB->set_field(
            'course_modules',
            'deletioninprogress',
            '1',
            ['course' => $this->course->id, 'section' => $sectioninfo->id]
        );

        // Move all modules to section 0.
        $sectionzero = $DB->get_record('course_sections', ['course' => $this->course->id, 'section' => '0']);
        $modules = $DB->get_records('course_modules', ['section' => $sectioninfo->id], '');
        foreach ($modules as $mod) {
            moveto_module($mod, $sectionzero);
        }

        $removaltask = new \core_course\task\course_delete_modules();
        $data = [
            'cms' => $affectedmods,
            'userid' => $USER->id,
            'realuserid' => \core\session\manager::get_realuser()->id,
        ];
        $removaltask->set_custom_data($data);
        \core\task\manager::queue_adhoc_task($removaltask);

        // Ensure we have the latest section info.
        $sectioninfo = $this->get_section_info($sectioninfo->id);
        return $this->delete_format_data($sectioninfo, $forcedeleteifnotempty, $event);
    }

    /**
     * Update a course section.
     *
     * @param section_info $sectioninfo the section info or database record to update.
     * @param array|stdClass $fields the fields to update.
     * @return bool whether section was updated
     */
    public function update(section_info $sectioninfo, array|stdClass $fields): bool {
        global $DB;

        $courseid = $this->course->id;

        // Some fields can not be updated using this method.
        $fields = array_diff_key((array) $fields, array_flip(['id', 'course', 'section', 'sequence']));
        if (array_key_exists('name', $fields) && \core_text::strlen($fields['name']) > 255) {
            throw new \moodle_exception('maximumchars', 'moodle', '', 255);
        }

        // If the section is delegated to a component, it may control some section values.
        $fields = $this->preprocess_delegated_section_fields($sectioninfo, $fields);

        if (empty($fields)) {
            return false;
        }

        $fields['id'] = $sectioninfo->id;
        $fields['timemodified'] = time();
        $DB->update_record('course_sections', $fields);

        $sectioninfo->get_component_instance()?->section_updated((object) $fields);

        // We need to update the section cache before the format options are updated.
        \course_modinfo::purge_course_section_cache_by_id($courseid, $sectioninfo->id);
        rebuild_course_cache($courseid, false, true);

        course_get_format($courseid)->update_section_format_options($fields);

        $event = \core\event\course_section_updated::create(
            [
                'objectid' => $sectioninfo->id,
                'courseid' => $courseid,
                'context' => \context_course::instance($courseid),
                'other' => ['sectionnum' => $sectioninfo->section],
            ]
        );
        $event->trigger();

        if (isset($fields['visible'])) {
            $this->transfer_visibility_to_cms($sectioninfo, (bool) $fields['visible']);
        }
        return true;
    }

    /**
     * Transfer the visibility of the section to the course modules.
     *
     * @param section_info $sectioninfo the section info or database record to update.
     * @param bool $visibility the new visibility of the section.
     */
    protected function transfer_visibility_to_cms(section_info $sectioninfo, bool $visibility): void {
        global $DB;

        if (empty($sectioninfo->sequence) || $visibility == (bool) $sectioninfo->visible) {
            return;
        }

        $modules = explode(',', $sectioninfo->sequence);
        $cmids = [];

        // In case the section is delegated by a module, we change also the visibility for the source module.
        if ($sectioninfo->is_delegated()) {
            $delegateinstance = $sectioninfo->get_component_instance();
            // We only return sections delegated by course modules. Sections delegated to other
            // types of components must implement their own methods to get the section.
            if ($delegateinstance && ($delegateinstance instanceof \core_courseformat\sectiondelegatemodule)) {
                $delegator = $delegateinstance->get_cm();
                $modules[] = $delegator->id;
            }
        }

        foreach ($modules as $moduleid) {
            $cm = get_coursemodule_from_id(null, $moduleid, $this->course->id);
            if (!$cm) {
                continue;
            }

            $modupdated = false;
            if ($visibility) {
                // As we unhide the section, we use the previously saved visibility stored in visibleold.
                $modupdated = set_coursemodule_visible($moduleid, $cm->visibleold, $cm->visibleoncoursepage, false);
            } else {
                // We hide the section, so we hide the module but we store the original state in visibleold.
                $modupdated = set_coursemodule_visible($moduleid, 0, $cm->visibleoncoursepage, false);
                if ($modupdated) {
                    $DB->set_field('course_modules', 'visibleold', $cm->visible, ['id' => $moduleid]);
                }
            }

            if ($modupdated) {
                $cmids[] = $cm->id;
                course_module_updated::create_from_cm($cm)->trigger();
            }
        }

        \course_modinfo::purge_course_modules_cache($this->course->id, $cmids);
        rebuild_course_cache($this->course->id, false, true);
    }

    /**
     * Preprocess the section fields before updating a delegated section.
     *
     * @param section_info $sectioninfo the section info or database record to update.
     * @param array $fields the fields to update.
     * @return array the updated fields
     */
    protected function preprocess_delegated_section_fields(section_info $sectioninfo, array $fields): array {
        $delegated = $sectioninfo->get_component_instance();
        if (!$delegated) {
            return $fields;
        }
        if (array_key_exists('name', $fields)) {
            $fields['name'] = $delegated->preprocess_section_name($sectioninfo, $fields['name']);
        }
        return $fields;
    }
}
