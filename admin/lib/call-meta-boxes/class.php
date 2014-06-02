<?php
/**
 * Call the Tickets custom post type meta fields
 *
 * @since  1.0.0
 */
class Gestio_Issues_Call_Meta_Boxes {
    /**
     * Class Constructor
     * 
     * @since     1.0.0
     */
    public function __construct() {
        include( plugin_dir_path( __FILE__ ) . 'meta-boxes/class-tickets-meta-boxes.php');
        include( plugin_dir_path( __FILE__ ) . 'meta-boxes/class-status-meta-boxes.php');
        if ( is_admin() ) {
            add_action( 'load-post.php', array( $this, 'call_meta_boxes' ) );
            add_action( 'load-post-new.php', array( $this, 'call_meta_boxes' ) );
        }
    }
    /**
     * Call the meta box class
     *
     * @since  1.0.0
     */
    public function call_meta_boxes() {
        $gestio_issues_status_meta_boxes = new Gestio_Issues_Status_Meta_Boxes();
        $gestio_issues_tickets_meta_boxes = new Gestio_Issues_Tickets_Meta_Boxes();
    }
}