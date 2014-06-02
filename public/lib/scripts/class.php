<?php
/**
 * Load the Public Scripts
 *
 * @since  1.0.0
 */
class Gestio_Issues_Public_Scripts {
    /**
     * Class Constructor
     *
     * @since  1.0.0 
     */
    public function __construct() {
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
    }
    /**
     * Scripts for the Frontend
     *
     * @since  1.0.0
     */
    public function enqueue_scripts() {
        wp_enqueue_script( GESTIO_ISSUES_SLUG, plugins_url( 'assets/js/public.js', dirname( __FILE__ ) ), array( 'jquery' ), GESTIO_ISSUES_VERSION, true );
    }
}