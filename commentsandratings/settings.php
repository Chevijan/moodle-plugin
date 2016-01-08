<?php

/**
 * Describes the form that can be accessed from:
 * Site Administration block -> Modules -> Activities -> Comment and Rating
 *
 * This file is useful when there is a setting that doesn't depend from the instance.
 * I.e., if your newmodule simulates a telephone, you will probably save your telephone number
 * in this newmodule setting site wide form instead of typing it each time you add a new instance
 * of your newmodule into a course.
 *
 * Ovo se pravi nakon lib.php i mod_form.php jer koristi stringove i fajlove iz njih.
 * Primer za sta cemo koristiti je display mode za rejtinge - Da li ce rejtinzi biti zvezdice ili
 * lajkovi ili nesto trece sta mi stavimo.
 *
 * Drugi primer: Da li admin zeli da komentari prolaze kroz moderaciju ili ne, recimo kao select box
 * i onda default bude da prolaze kroz moderaciju, a moze i da iskljuci
 *
 * @package    mod_commentandrating
 * @copyright  2016 Vuk Nikolic <nikolicm.vuk@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
    require_once($CFG->dirroot . '/mod/commentandrating/lib.php');

    //samo test
    $settings->add(new admin_setting_configselect('forum_maxbytes', get_string('maxattachmentsize', 'forum'),
        get_string('configmaxbytes', 'forum'), 512000, get_max_upload_sizes($CFG->maxbytes, 0, 0, $maxbytes)));


}


