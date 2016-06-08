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

defined('MOODLE_INTERNAL') || die();

class block_comments_and_ratings extends block_base {

    function init() {
        $this->title = get_string('pluginname', 'block_comments_and_ratings');
    }
    
    public function specialization() {
        if (isset($this->config)) {
            if (empty($this->config->title)) {
                $this->title = get_string('defaulttitle', 'block_comments_and_ratings');            
            } else {
                $this->title = $this->config->title;
            }

            if (empty($this->config->text)) {
                $this->config->text = get_string('defaulttext', 'block_comments_and_ratings');
            }    
        }
    }
    
    public function instance_allow_multiple() {
        return false;
    }
    
    public function has_config() {
        return true;
    }
    
    public function applicable_formats() {
        return array('course-view' => true);
    }
    
    public function get_content() {
        
        global $COURSE;
        
        if ($this->content !== null) {
            return $this->content;
        }
 
        $this->content =  new stdClass; 

        $this->content->text = 'Ratings should be displayed here.';
        
        //ako oces da promenis url-ove da ima vise dinamicnkih view-a, pogledaj klip 14 oko 16 minuta
        $url_comments_ratings = new moodle_url('/blocks/comments_and_ratings/view.php', array('blockid' => $this->instance->id, 'courseid' => $COURSE->id));
        
        $this->content->footer = html_writer::link($url_comments_ratings, 'display all comments and ratings');
        return $this->content;
    }
}   

