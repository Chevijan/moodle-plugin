<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Replace commentandrating with the name of your module and remove this line.

require_once(dirname(dirname(dirname(__FILE__))).'/config.php');
require_once(dirname(__FILE__).'/lib.php');

global $DB;
$id = optional_param('id', 0, PARAM_INT); // Course_module ID, or
$n  = optional_param('n', 0, PARAM_INT);  // ... commentandrating instance ID - it should be named as the first character of the module.

if ($id) {
    $cm         = get_coursemodule_from_id('commentandrating', $id, 0, false, MUST_EXIST);
    $course     = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);
    $commentandrating  = $DB->get_record('commentandrating', array('id' => $cm->instance), '*', MUST_EXIST);
} else if ($n) {
    $commentandrating  = $DB->get_record('commentandrating', array('id' => $n), '*', MUST_EXIST);
    $course     = $DB->get_record('course', array('id' => $commentandrating->course), '*', MUST_EXIST);
    $cm         = get_coursemodule_from_instance('commentandrating', $commentandrating->id, $course->id, false, MUST_EXIST);
} else {
    error('You must specify a course_module ID or an instance ID');
}

require_login($course, true, $cm);

$event = \mod_commentandrating\event\course_module_viewed::create(array(
    'objectid' => $PAGE->cm->instance,
    'context' => $PAGE->context,
));
$event->add_record_snapshot('course', $PAGE->course);
$event->add_record_snapshot($PAGE->cm->modname, $commentandrating);
$event->trigger();

// Print the page header.

$PAGE->set_url('/mod/commentandrating/view.php', array('id' => $cm->id));
$PAGE->set_title(format_string($commentandrating->name));
$PAGE->set_heading(format_string($course->fullname));

/*
 * Other things you may want to set - remove if not needed.
 * $PAGE->set_cacheable(false);
 * $PAGE->set_focuscontrol('some-html-id');
 * $PAGE->add_body_class('commentandrating-'.$somevar);
 */

// Output starts here.
echo $OUTPUT->header();

// Replace the following lines with you own code.
echo $OUTPUT->heading($commentandrating->name);


//Prikazivanje svih resursa, ovo ce sve ici u funkciju u locallib gde ce se 
//izlistavati komentari za svaki resurs
$id_array = $DB->get_records('resource', null, $sort='', $fields='*', $limitfrom=0, $limitnum=0);

foreach ($id_array as $value) {
     echo $value->name . '<br>';
     
     echo '<a href="#">Comments</a>';
     echo '<hr>';
}

// Finish the page.
echo $OUTPUT->footer();
