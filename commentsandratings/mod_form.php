<?php

/**
 * @package   mod_commentandrating
 * @copyright 2016 Vuk Nikolic <nikolicm.vuk@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once ($CFG->dirroot.'/course/moodleform_mod.php');

class mod_commentandrating_mod_form extends moodleform_mod {

    public function definition()
    {
        global $CFG;

        $mform = $this->_form;

        // Adding the standard "name" field.
        $mform->addElement('textarea', 'name', get_string('Naziv elementa', 'commentandrating'), array('size' => '64'));
        if (!empty($CFG->formatstringstriptags)) {
            $mform->setType('name', PARAM_TEXT);
        } else {
            $mform->setType('name', PARAM_CLEANHTML);
        }

    }

}
