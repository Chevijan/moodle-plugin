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
 * Helper functions for course_overview block
 *
 * @package    blocks
 * @subpackage comments_and_ratings
 * @copyright  2016 Vuk Nikolic <nikolicm.vuk@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define('BLOCKS_COMMENTS_AND_RATINGS_RATINGTYPE_STARS', '0');
define('BLOCKS_COMMENTS_AND_RATINGS_RATINGTYPE_LIKES', '1');
define('BLOCKS_COMMENTS_AND_RATINGS_RATINGTYPE_PERCENTS', '2');

//Required for comments
require_once($CFG->dirroot . '/comment/lib.php');
require_once($CFG->dirroot.'/rating/lib.php');
require_once 'lib.php';

/**
 * 
 * 
 * 
 * 
 * 
 */
function render_content($course, $modinfo, $page_context) {
    global $DB;
    
    $rendered_course = $DB->get_record('course', array('id' => $course->id));
    $rendered_course_id = $rendered_course->id;
    $sections = $DB->get_records('course_sections', array('course' => $rendered_course_id));
    $modules = $DB->get_records('course_modules', array('course' => $rendered_course_id));

    //must have for comments
    comment::init();

    render_sections($course, $sections, $modules, $modinfo, $page_context);
}

function render_title($course, $title) {
    //Prepravi ovo u html_writer() moodle-ovu funkciju
    echo '<div class=page-heading style="font-size: 20px;">' . $course->fullname . ' - ' . $title . '</div><br>';
}

/**
 * 
 * 
 * 
 * 
 */
function render_sections($course, $sections, $modules, $modinfo, $page_context) {

    $course_startdate = date('d-M', $course->startdate);
    $day_counter = 0;

    //for now it only works on week format
    if ($course->format == 'weeks') {

        foreach ($sections as $section) {
            
            //Avoid displaying comments and ratings for 'News forum'
            if($section->id == 1) {
                continue;
            }
            
            //This is ugly hack for displaying week dates.
            //Maybe there is a way of implementing his entire section
            //by overriding renderers
            $section_startdate = date('d M', strtotime($course_startdate . '+' . $day_counter . ' days'));
            $section_enddate = date('d M', strtotime($section_startdate . '+6 days'));
            $day_counter = $day_counter + 7;
            //Prepravi ovo u html_writer() moodle-ovu funkciju
            echo '<div class="sections" style="font-size: 24px; font-weight:600">' . $section_startdate . ' - ' . $section_enddate . '</div>' . '<br>';
                    
            render_resources_comments_ratings($course, $modules, $modinfo, $section, $page_context);
        }
    }
}

/**
 * 
 * 
 * 
 * 
 */
function render_resources_comments_ratings($course, $modules, $modinfo, $section, $page_context) {
    global $USER, $OUTPUT;
    
    foreach ($modules as $module) {

        $cm = $modinfo->get_cm($module->id);

        //Avoid comments and ratings for default 'News forum'
        if ($module->section == $section->id && $cm->name != 'News forum') {
            
            $url = new moodle_url('/mod/resource/view.php?id=' . $module->id);
        
            echo html_writer::link($url, $cm->name);
//            echo $cm->name . '<br>';

            $args = new stdClass;
            $args->context = $page_context;
            $args->course = $course;
            $args->area = 'resource';
            $args->itemid = $module->id;
            $args->component = 'block_comments_and_ratings';
            $args->showcount = true;
            $comment = new comment($args);
            $comment->set_fullwidth();
            $comment->output(false);
            
            echo '<hr>';
            
            
//            $ratingargs = new stdClass;
//            $ratingargs->context = $page_context;
//            $ratingargs->component = 'block_comments_and_ratings';
//            $ratingargs->ratingarea = 'resource';
//            $ratingargs->items = $modules;  
//            $ratingargs->userid = $USER->id;
//            $ratingargs->scaleid = 1;
//            $ratingargs->aggregate = $cm->name;
//            $rm = new rating_manager();
//            $modules = $rm->get_ratings($ratingargs);
//            
//            $output .= $OUTPUT->render($module->rating);
            
        }
    }
}
    