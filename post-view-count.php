<?php
/*
 * Plugin Name:       Post View Count
 * Plugin URI:
 * Description:       A WordPress plugin that displays total view count of each post.
 * Version:           1.0.0
 * Author:            Emrul Hakkani
 * Author URI:        https://smartwebers.com
 * Text Domain:       view-count
 * Domain Path:       /languages
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    wp_die();
}

// Require composer autoload
// Use fle namespace to include any file
require_once __DIR__ . "/vendor/autoload.php";

/*
 * Include files using their namespace using composer
 */

/**
 * Class Em_View_Count
 * Main class for the Post View Count plugin.
 */
if ( !class_exists( "Em_Post_View_Count" ) ) {
    class Em_Post_View_Count {

        /**
         * Constructor for the Em_Post_View_Count class.
         * Hooks into the 'init' action to initialize the class.
         */
        public function __construct() {
            add_action( "init", array( $this, "init" ) );
        }

        /**
         * Initialization function.
         * Hooks for post view count display and script enqueue.
         */
        public function init() {
            /*
             * ADMIN
             * Function that run on each single post to save the visit count in post meta
             */
            new Pvc\Includes\Admin\Counter();

            /*
             * ADMIN
             * Function to display post count and shortcode in admin column
             */
            new Pvc\Includes\Admin\View();

            /*
             * Visitor
             * Function to display post count below the post content
             */
            new Pvc\Includes\Template\View();

            /*
             * Visitor
             * Function to display post count using shortcode
             * Use [counter id="post-id"]
             * parameter accepts: sticky="true" to make the counter stickey at the bottom left
             */
            new Pvc\Includes\Template\Shortcode();

            //Initialization of enqueue scripts
            add_action( "wp_enqueue_scripts", array( $this, "load_scripts" ) );

        }

        /*
         * Enqueue scripts and styles for the plugin
         */
        public function load_scripts() {

            //Add custom style
            wp_enqueue_style( "em-view-count-css", plugins_url( "assets/css/style.css", __FILE__ ) );
        }

    }
    // Instantiate the Em_Post_View_Count class to initialize the plugin.
    new Em_Post_View_Count();
}