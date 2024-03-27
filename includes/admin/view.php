<?php

namespace Pvc\Includes\Admin;

/*
 * Main class to display visit number in admin column
 * Create a shortcode in admin column to easily copy shortcode and dispaly count number anywhere
 */
class View {

    /*
     * Constructor function
     * It runs action and filter hooks to add new columns in posts view list
     */
    public function __construct() {
        // Add View Count column
        add_filter( "manage_posts_columns", array( $this, "add_view_count_column" ) );

        // Make the View Count column sortable
        add_action( "manage_edit-post_sortable_columns", array( $this, "add_sortable_view_count_column" ) );

        // Display the count number and shotcode
        add_action( "manage_posts_custom_column", array( $this, "manage_view_count_column" ), 10, 2 );
    }

    /*
     * Function that returns an array '$columns' to main action hook
     * We added 'count' to the array
     */
    public function add_view_count_column( $columns ) {
        $columns["count"] = __( "View Count", "view-count" );
        return $columns;
    }

    /*
     * Function that make any column sortable
     * We added 'count' to the array to make it sortable
     */
    public function add_sortable_view_count_column( $columns ) {
        $columns["count"] = __( "Veiw Count", "view-count" );
        return $columns;
    }

    /*
     * Function that echo visit and shotcode values to the main hook
     */
    public function manage_view_count_column( $column_name, $post_id ) {

        //check if is it 'count' column
        if ( "count" == $column_name ) {
            //update_post_meta( $post_id, "em_view_count", '' );

            //Get the view number from post meta
            $count = get_post_meta( $post_id, 'em_view_count', true );

            // Display number of views
            echo "<strong>Total View:</strong> " . $count . "<br>";

            //Display the shortcode
            echo "<strong>Shortcode:</strong> <code>" . esc_html( "[counter id=\"{$post_id}\"/]" ) . "</code><br>";
        }
    }

}