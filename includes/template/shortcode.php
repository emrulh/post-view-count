<?php
namespace Pvc\Includes\Template;

/*
 * Main class to create and display post view count using shortcode
 */

class Shortcode {

    /*
     * Constructor to initialize add_shortcode hook
     */

    public function __construct() {

        //Add counter shortcode
        add_shortcode( "counter", array( $this, "render_counter" ) );
    }

    /*
     * Function to return post view count by their id
     * It requires the post id to load
     */
    public function render_counter( $atts ) {

        /*
         * Get all attributes from the shortcode
         * id is required
         */
        $atts = shortcode_atts( [
            "id"     => " ",
            "sticky" => false,
        ], $atts );

        $post_id = esc_attr( $atts["id"] );

        /*
         * Check if there is a post id set from the shortcode
         * Return error if empty $post_id
         */
        if ( empty( $post_id ) ) {
            return "<p>id is required!</p>";
        } else {

            //get post view count from post meta
            $count = get_post_meta( $post_id, "em_view_count", true );

            /*
             * Fix view number if shortcode is used inside current post
             * We need to add +1 to show current visit number
             * Skip counter increment if current page is not single post
             */
            $current_id = get_the_ID();
            if ( is_single() && 'post' === get_post_type() && $post_id == $current_id ) {
                //increase number by 1
                $count++;
            }

            //set count number 0 if is empty and used on other page
            if ( empty( $count ) ) {
                $count = 0;
            }

            //Get post count box template from Count_Box class
            $counter = new \Pvc\Includes\Template\Count_Box( $count, $atts['sticky'] );

            //return counter box
            return $counter->display_counter_box();
        }

    }
}