<?php
namespace Pvc\Includes\Template;

/*
 * Main class to display post count box
 * It used on single post and shortocde
 */
class Count_Box {
    private $number, $sticky;

    //Constructor to get the view number when initiate this class
    public function __construct( $count, $sticky = false ) {
        $this->number = $count;

        //update $sticky variable to use as a class
        if ( $sticky ) {
            $this->sticky = 'sticky';
        }
    }

    //function to return the view box
    public function display_counter_box() {
        ob_start();

        echo "<div class='em-post-count-box {$this->sticky}'>";
        echo "<div class='em-post-count'>";
        echo "<h4>Post Views</h4>";
        echo "<p>Total Views: {$this->number}</p>";
        echo "</div>";
        echo "</div>";

        return ob_get_clean();
    }
}