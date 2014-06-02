<?php
/**
 * Load the Admin scripts
 *
 * @since  1.0.0
 */
class Gestio_Issues_Admin_Scripts {
    /**
     * Class Constructor
     *
     * @since  1.0.0
     */
    public function __construct() {
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles' ) );
    }
    /**
     * Scripts for the Admin
     *
     * @since  1.0.0
     */
    public function enqueue_styles() {
        wp_enqueue_script( GESTIO_ISSUES_SLUG, plugins_url( 'assets/js/admin.js', dirname( dirname( __FILE__ ) ) ), array( 'jquery' ), GESTIO_ISSUES_VERSION, true );
    }
}