<?php

class comments_renderrer {
    
    public function displayComments($resource_id, $instance) {
        //instance ce u stvari biti ovo gde dodamo (add_instance), na stranici kursa
        //Mozda prvo da se izlistaju svi resursi pa da se omoguce komentari
        
        comment::init();

        $options = new stdClass();
        $options->area    = 'resource_comments';
        $options->course    = $course;
        $options->context = $context;
        $options->itemid  = $itemid;
        $options->component = 'component_1';
        $options->showcount = true;
        $options->displaycancel = true;

        $comment = new comment($options);
        $comment->set_view_permission(true);
    }
    
}