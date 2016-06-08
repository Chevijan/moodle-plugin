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
 * @package    block_comments_and_ratings
 * @copyright  Vuk Nikolic <nikolicm.vuk@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require_once '../../config.php';
require_once '../../course/lib.php';
require_once 'locallib.php';

defined('MOODLE_INTERNAL') || die();

global $DB, $OUTPUT, $PAGE;

//getting the course id so we can link to specific course
$courseid = required_param('courseid', PARAM_INT);

//for breadcrumbs
$blockid = required_param('blockid', PARAM_INT);

// Next look for optional variables.
$id = optional_param('id', 0, PARAM_INT);

//error handling
if (!$course = $DB->get_record('course', array('id' => $courseid))) {
    print_error('invalidcourse', 'block_comments_and_ratings', $courseid);
}

// for geting $cm later on
$modinfo = get_fast_modinfo($course);

//moodle require_login method which handles lots of things in background
require_login($course);

//$PAGE settings from PAGE_API
$PAGE->set_url(new moodle_url('/blocks/comments_and_ratings/view.php', array('id' => $courseid)));
$PAGE->set_context(context_course::instance($courseid));
$PAGE->set_title('Comments And Ratings');
$PAGE->set_heading($COURSE->fullname);
$PAGE->set_pagelayout('course');
$PAGE->set_pagetype('course-view-' . $course->format);
$PAGE->set_cacheable(false);

//Creating breadcrumbs
$settingsnode = $PAGE->settingsnav->add(get_string('commentsandratingssettings', 'block_comments_and_ratings'));
$editurl = new moodle_url('/blocks/comments_and_ratings/view.php', array('id' => $id, 'courseid' => $courseid, 'blockid' => $blockid));
$editnode = $settingsnode->add(get_string('editpage', 'block_comments_and_ratings'), $editurl);
$editnode->make_active();

print $OUTPUT->header();

render_title($course, $PAGE->title);

render_content($course, $modinfo, $PAGE->context);


//Moze se dodati jos sta god padne na pamet. 
//Npr rejtinzi

print $OUTPUT->footer();


