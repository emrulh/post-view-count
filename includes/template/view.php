<?php
namespace Pvc\Includes\Template;

/*
 * Main class to display visit number under post content
 */

class View {

    // Constructor to initialization of action hool
    public function __construct() {
        add_action( "the_content", array( $this, "render_count" ) );
    }

    /**
     * Return view count at the end of the main content.
     */
    public function render_count( $content ) {
        //Run code only for Single post
        if ( is_single() && 'post' == get_post_type() ) {

            //get current post id
            $post_id = get_the_ID();

            //Get view count from post meta
            $count = get_post_meta( $post_id, "em_view_count", true );

            //Add visit box after main content
            if ( $count == '' || $count > 0 ) {
                //Fix number by adding +1 on current visit
                $count++;

                //Get post count box template from Count_Box class
                $counter = new \Pvc\Includes\Template\Count_Box( $count );

                //return counter box
                $content .= $counter->display_counter_box();
            }
        }

        //Return modified or main content to the hook
        return $content;
    }
}