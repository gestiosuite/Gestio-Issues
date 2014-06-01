<?php
/**
 * Load the Public styles
 *
 * @since  1.0.0
 */
class Gestio_Issues_Public_Styles extends Gestio_Issues_Singleton {
    /**
     * Class Constructor
     *
     * @since  1.0.0 
     */
    protected function __construct() {
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
    }
    /**
     * Styles for the Frontend
     *
     * @since  1.0.0
     */
    public function enqueue_styles() {
        wp_enqueue_style( $this->plugin_slug, plugins_url( 'assets/css/public.css', dirname( __FILE__ ) ), array(), $this->version );
    }
}