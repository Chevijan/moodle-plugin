<?php

/**
 * Index page where admin can see all the comments from chosen resource of chosen course.
 *
 * @package    mod_commentandrating
 * @copyright  2016 Vuk Nikolic <nikolicm.vuk@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// File: /mod/commentandrating/view.php
require_once('../../config.php');

//id course module-a
$cmid = required_param('id', PARAM_INT);

//Mozda nije dobro zbog prvog parametra, u svakom slucaju vraca informacije o modulu na osnnovu ID-a
$cm = get_coursemodule_from_id('resource', $cmid, 0, false, MUST_EXIST);
$course = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);

//Daje nam i kurs i kurs modul
require_login($course, true, $cm);
$PAGE->set_url('/mod/commentandrating/view.php', array('key' => 'value', 'id' => $cm->id));
$PAGE->set_title('Comments and Ratings');
$PAGE->set_heading($course->fullname);
$PAGE->set_pagelayout('incourse');
$PAGE->set_cacheable(true);

$modulecontext = context_module::instance($cmid);

