<?php
namespace Pvc\Includes\Admin;

/**
 * Class Counter
 * Main class that count the visit number for each post.
 * It saves visit number as post meta
 */
class Counter {

    /*
     * Constructor for the Counter class
     */
    public function __construct() {
        //It loads with wp_footer on each page load
        add_action( "wp_footer", [$this, "update_visit_number"] );
    }

    /*
     *  This class ads functionality to get and update visit number
     */
    public function update_visit_number() {

        //Run code only for Single post
        if ( is_single() && 'post' == get_post_type() ) {
            $post_id = get_the_ID();
            $visit = get_post_meta( $post_id, "em_view_count", true );
            $count = $visit == '' ? 1 : $visit + 1;

            //update post meta with increased number
            update_post_meta( $post_id, 'em_view_count', $count );
        }
    }
}