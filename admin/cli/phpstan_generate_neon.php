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
 * Generate PHPStan neon file
 *
 * @package    core
 * @subpackage cli
 * @copyright  2023 Te Pūkenga – New Zealand Institute of Skills and Technology
 * @author     James Calder
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later (or CC BY-SA v4 or later)
 */

define('CLI_SCRIPT', true);

require(__DIR__ . '/../../config.php');

$neon = "";

$neon .= "parameters:\n";

$neon .= "    bootstrapFiles:\n";
$neon .= "        - admin/cli/phpstan_bootstrap.php\n";
$neon .= "    scanFiles:\n";
$neon .= "        - config-dist.php\n";
$neon .= "    scanDirectories:\n";
$neon .= "        - lib\n";

$neon .= "    typeAliases:\n";

$tablelist = $DB->get_tables();
foreach ($tablelist as $tablename) {

    $neon .= "        {$tablename}_db: 'stdClass&object{";
    $tabledesc = $DB->get_columns($tablename);
    $lastfield = array_key_last($tabledesc);

    foreach ($tabledesc as $fieldname => $fielddesc) {
        list($type, $notnull) = [ $fielddesc->type, $fielddesc->not_null ];
        $bracketpos = strpos($type, '(');
        if ($bracketpos !== false) {
            $type = substr($type, 0, $bracketpos);
        }
        if (in_array($type, ['int', 'smallint', 'bigint', 'tinyint', 'mediumint'])) {
            $type = 'numeric-string';
        } else if (in_array($type, ['float', 'double'])) {
            $type = 'numeric-string';
        } else if (in_array($type, ['decimal'])) {
            $type = 'numeric-string';
        } else if (in_array($type, ['char', 'varchar', 'text', 'longtext'])) {
            $type = 'string';
        } else {
            $type = 'string';
        }
        $neon .= "{$fieldname}:" . ($notnull ? '' : '?') . $type . ($fieldname != $lastfield ? ',' : '');
    }

    $neon .= "}'\n";

}

file_put_contents('../../phpstan.neon.dist', $neon);
