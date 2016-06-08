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
 * Comments And Ratings block caps.
 *
 * @package    block
 * @subpackage comments_and_ratings
 * @copyright  Vuk Nikolic <nikolicm.vuk@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once 'locallib.php';

defined('MOODLE_INTERNAL') || die();

// Title and description of configuration 
$settings->add(new admin_setting_heading('headerconfig',
                                         get_string('headerconfig', 'block_comments_and_ratings'),
                                         get_string('ratingtype', 'block_comments_and_ratings')));

//Adding options for rating types
$ratingtype = array(
        BLOCKS_COMMENTS_AND_RATINGS_RATINGTYPE_STARS => new lang_string('labelratingstars', 'block_comments_and_ratings'),
        BLOCKS_COMMENTS_AND_RATINGS_RATINGTYPE_LIKES => new lang_string('labelratinglikes', 'block_comments_and_ratings'),
        BLOCKS_COMMENTS_AND_RATINGS_RATINGTYPE_PERCENTS => new lang_string('labelratingpercents', 'block_comments_and_ratings')
    );

$settings->add(new admin_setting_configselect('block_comments_and_ratings/ratings', new lang_string('ratingtype', 'block_comments_and_ratings'),
    new lang_string('ratingtypedesc', 'block_comments_and_ratings'), BLOCKS_COMMENTS_AND_RATINGS_RATINGTYPE_STARS, $ratingtype));