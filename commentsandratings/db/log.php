<?php
/**
 * Commentsandratings module log events definition
 *
 * @package    mod_commentsandratings
 * @copyright  2015 Vuk Nikolic <nikolicm.vuk@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$logs = array(
    array('module' => 'commentsandratings', 'action' => 'add_comment', 'mtable' => 'resource_comments', 'field' => 'id'),
    array('module' => 'commentsandratings', 'action' => 'update_comment', 'mtable' => 'resource_comments', 'field' => 'id'),
    array('module' => 'commentsandratings', 'action' => 'view_comment', 'mtable' => 'resource_comments', 'field' => 'id'),
    array('module' => 'commentsandratings', 'action' => 'delete_comment', 'mtable' => 'resource_comments', 'field' => 'id'),
    array('module' => 'commentsandratings', 'action' => 'view_comment', 'mtable' => 'resource_comments', 'field' => 'id'),
    array('module' => 'commentsandratings', 'action' => 'add_rating', 'mtable' => 'resource_ratings', 'field' => 'id'),
    array('module' => 'commentsandratings', 'action' => 'view_rating', 'mtable'=> 'resource_ratings', 'field' => 'id'),
);
