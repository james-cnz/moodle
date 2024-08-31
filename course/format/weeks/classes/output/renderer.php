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
 * Renderer for outputting the weeks course format.
 *
 * @package format_weeks
 * @copyright 2012 Dan Poltawski
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @since Moodle 2.3
 */

namespace format_weeks\output;

use core_courseformat\output\section_renderer;

/**
 * Basic renderer for weeks format.
 *
 * @copyright 2012 Dan Poltawski
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class renderer extends section_renderer {

    /**
     * Generate the section title, optionally wraps it in a link to the section page if page is to be displayed on a separate page.
     *
     * @param \section_info|\stdClass $section The course section object
     * @param stdClass $course The course entry from DB
     * @param bool $linkifneeded Whether to wrap in a link
     * @return string HTML to output.
     */
    public function section_title_opt_link(\section_info|\stdClass $section, \stdClass $course, bool $linkifneeded): string {
        $format = course_get_format($course);
        $title = $this->render($format->inplace_editable_render_section_name($section, $linkifneeded));
        $subtitle = $format->get_section_subtitle($section);

        if ($subtitle != null) {
            $subtitle = \html_writer::tag('span', $subtitle , ['class' => 'section-subtitle h6']);
            $title = $title . \html_writer::empty_tag('br') . $subtitle;
        }

        return $title;
    }
}
