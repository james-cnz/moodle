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

/**
 * Defines restore_course_final_task class
 *
 * @package     core
 * @subpackage  backup-moodle2
 * @category    backup
 * @copyright   2026 James Calder and Otago Polytech
 * @copyright   based on work by 2010 onwards Eloy Lafuente (stronk7) {@link http://stronk7.com}
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Course task that provides all the properties and common steps to be performed
 * to finalise course restore
 */
class restore_course_final_task extends restore_task {
    /** @var object info related to course gathered from backup file */
    protected object $info;

    /** @var int course context id */
    protected int $contextid;

    /**
     * Constructor - instantiates one object of this class
     *
     * @param string $name
     * @param object $info
     * @param restore_plan|null $plan
     */
    public function __construct(string $name, object $info, ?restore_plan $plan = null) {
        $this->info = $info;
        parent::__construct($name, $plan);
    }

    /**
     * Course tasks have their own directory to read files
     *
     * @return string
     */
    public function get_taskbasepath(): string {
        return $this->get_basepath() . '/course';
    }

    /**
     * Returns context ID
     *
     * @return int context ID
     */
    public function get_contextid(): int {
        return $this->contextid;
    }

    /**
     * Create all the steps that will be part of this task
     */
    public function build(): void {
        // Define the task contextid (the course one).
        $this->contextid = context_course::instance($this->get_courseid())->id;

        // Executed conditionally if restoring to new course or if overwrite_conf setting is enabled.
        if ($this->get_target() == backup::TARGET_NEW_COURSE || $this->get_setting_value('overwrite_conf') == true) {
            $this->add_step(new restore_course_final_structure_step('course_info', 'course.xml'));
        }

        // At the end, mark it as built.
        $this->built = true;
    }

    // Protected API starts here.

    /**
     * Define the common setting that any restore course will have
     */
    protected function define_settings(): void {
    }
}
