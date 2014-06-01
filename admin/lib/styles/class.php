<?php
/**
 * Load the Admin Styles
 *
 * @since  1.0.0
 */
class Gestio_Issues_Admin_Styles extends Gestio_Issues_Singleton {
    /**
     * Class Constructor
     *
     * @since  1.0.0
     */
    protected function __construct() {
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles' ) );
    }
    /**
     * Styles for the Admin
     *
     * @since  1.0.0
     */
    public function enqueue_styles() {
        wp_enqueue_style( GESTIO_ISSUES_SLUG, plugins_url( 'assets/css/admin.css', dirname( dirname( __FILE__ ) ) ), array(), GESTIO_ISSUES_VERSION );
    }
}