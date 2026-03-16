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

namespace core;

use core_backup_backup_restore_base_testcase;

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once('backup_restore_base_testcase.php');
require_once($CFG->dirroot . '/backup/util/includes/backup_includes.php');
require_once($CFG->dirroot . '/backup/util/includes/restore_includes.php');

/**
 * Backup restore course section URLs test.
 *
 * @package    core
 * @subpackage backup
 * @copyright  2026 James Calder and Otago Polytechnic
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @covers     \backup_course_task
 * @covers     \restore_course_task
 * @covers     \restore_decode_rule
 */
final class backup_restore_course_section_url_test extends core_backup_backup_restore_base_testcase {
    /**
     * Test for backup/restore course section URLs.
     */
    public function test_backup_restore_course_section_url(): void {
        global $DB;

        // Create course.
        $backupcourse = self::getDataGenerator()->create_course(['numsections' => 1]);
        $subsectionmod = $this->getDataGenerator()->create_module(
            'subsection',
            (object)['course' => $backupcourse->id, 'section' => 1]
        );

        // Create links.
        $format = course_get_format($backupcourse);
        $sections = $format->get_sections();
        $backupurlbase = $format->get_view_url(null)->out();
        $backupurlsection = $format->get_view_url($sections[1], ['navigation' => true])->out();
        $backupurls = [
            $backupurlbase,
            $backupurlbase . "&sectionid={$sections[1]->id}",
            $backupurlbase . "#sectionid-{$sections[1]->id}-title",
            $backupurlbase . "&sectionid={$sections[1]->id}" . "#sectionid-{$sections[2]->id}-title",
            $backupurlsection,
            $backupurlsection . "#sectionid-{$sections[2]->id}-title",
        ];
        foreach ($backupurls as $index => $backupurl) {
            $backuplinkinstance = self::getDataGenerator()->create_module(
                'url',
                ['course' => $backupcourse->id, 'section' => 0, 'name' => "link{$index}"]
            );
            $DB->set_field('url', 'externalurl', $backupurl, ['id' => $backuplinkinstance->id]);
        }

        // Perform backup and restore.
        $backupid = $this->perform_backup($backupcourse);
        $restorecourse = self::getDataGenerator()->create_course(['numsections' => 0]);
        $this->perform_restore($backupid, $restorecourse);

        // Check links.
        $format = course_get_format($restorecourse);
        $sections = $format->get_sections();
        $restoreurlbase = $format->get_view_url(null)->out();
        $restoreurlsection = $format->get_view_url($sections[1], ['navigation' => true])->out();
        $restoreurls = [
            $restoreurlbase,
            $restoreurlbase . "&sectionid={$sections[1]->id}",
            $restoreurlbase . "#sectionid-{$sections[1]->id}-title",
            $restoreurlbase . "&sectionid={$sections[1]->id}" . "#sectionid-{$sections[2]->id}-title",
            $restoreurlsection,
            $restoreurlsection . "#sectionid-{$sections[2]->id}-title",
        ];
        $restorelinkids = $format->get_modinfo()->get_sections()[0];
        foreach ($restoreurls as $index => $restoreurl) {
            $restorelink = $format->get_modinfo()->get_cm($restorelinkids[$index]);
            $restorelinkurl = $restorelink->get_instance_record()->externalurl;
            $this->assertEquals($restoreurl, $restorelinkurl);
        }
    }
}
