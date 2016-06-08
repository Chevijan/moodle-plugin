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

defined('MOODLE_INTERNAL') || die();


function block_comments_and_ratings_comment_validate($comment_param) {
    if ($comment_param->commentarea != 'resource') {
        throw new comment_exception('invalidcommentarea');
    }
    
    return true;
}


function block_comments_and_ratings_comment_permissions($args) {
    return array('post'=>true, 'view'=>true);
}


function block_comments_and_ratings_comment_display($comments, $args) {
    if ($args->commentarea != 'resource') {
        throw new comment_exception('invalidcommentarea');
    }
    
    return $comments;
}

function block_comments_and_ratings_comment_add($comment, $args) {
    
}

