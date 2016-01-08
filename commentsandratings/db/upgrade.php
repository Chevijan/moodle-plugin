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
 * This file keeps track of upgrades to the newmodule module
 *
 * Sometimes, changes between versions involve alterations to database
 * structures and other major things that may break installations. The upgrade
 * function in this file will attempt to perform all the necessary actions to
 * upgrade your older installation to the current version. If there's something
 * it cannot do itself, it will tell you what you need to do.  The commands in
 * here will all be database-neutral, using the functions defined in DLL libraries.
 *
 * @package    mod_newmodule
 * @copyright  2016 Vuk Nikolic <nikolicm.vuk@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

function xmldb_commentandrating_upgrade($oldvesrion) {
    global $DB;
    
    $dbman = $DB->get_manager();
    
    if ($oldversion < 2016010700) {

        // Define field course to be added to newmodule.
        $table = new xmldb_table('commentandrating');
        $field = new xmldb_field('comment', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0', 'course');

        // Add field course.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Define field intro to be added to newmodule.
        $table = new xmldb_table('commentandrating');
        $field = new xmldb_field('rating', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0', 'comment');

        // Add field intro.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Define field introformat to be added to newmodule.
        $table = new xmldb_table('commentandrating');
        $field = new xmldb_field('resource', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0',
            'rating');

        // Add field introformat.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }
        
        // Define field introformat to be added to newmodule.
        $table = new xmldb_table('commentandrating');
        $field = new xmldb_field('approved', XMLDB_TYPE_INTEGER, '1', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, '0',
            'resource');

        // Add field introformat.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }
        
        // Define index course (not unique) to be added to newmodule.
        $table = new xmldb_table('commentandrating');
        $index = new xmldb_index('commentindex', XMLDB_INDEX_NOTUNIQUE, array('comment'));

        // Add index to course field.
        if (!$dbman->index_exists($table, $index)) {
            $dbman->add_index($table, $index);
        }
        
        // Define index course (not unique) to be added to newmodule.
        $table = new xmldb_table('commentandrating');
        $index = new xmldb_index('ratingindex', XMLDB_INDEX_NOTUNIQUE, array('rating'));

        // Add index to course field.
        if (!$dbman->index_exists($table, $index)) {
            $dbman->add_index($table, $index);
        }
        
        // Define index course (not unique) to be added to newmodule.
        $table = new xmldb_table('commentandrating');
        $index = new xmldb_index('resourceindex', XMLDB_INDEX_NOTUNIQUE, array('resource'));

        // Add index to course field.
        if (!$dbman->index_exists($table, $index)) {
            $dbman->add_index($table, $index);
        }
        
        // Define index course (not unique) to be added to newmodule.
        $table = new xmldb_table('commentandrating');
        $index = new xmldb_index('courseindex', XMLDB_INDEX_NOTUNIQUE, array('course'));

        // Add index to course field.
        if (!$dbman->index_exists($table, $index)) {
            $dbman->add_index($table, $index);
        }

        // Once we reach this point, we can store the new version and consider the module
        // ... upgraded to the version 2007040100 so the next time this block is skipped.
        upgrade_mod_savepoint(true, 2016010700, 'commentandrating');
    }
    
    return true;
}
