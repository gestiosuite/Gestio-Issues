<?php
/**
 * Load the Public styles
 */
class Prefix_Public_Styles {
    /**
     * Class Constructor
     *
     * @param string $prefix_slug The plugin slug
     * @param string $prefix_versionThe plugin version 
     */
    public function __construct( $prefix_slug, $prefix_version) {
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
        $this->plugin_slug = $prefix_slug;
        $this->version = $prefix_version;
    }
    public function enqueue_styles() {
        wp_enqueue_style( $this->plugin_slug, plugins_url( 'assets/css/public.css', dirname( __FILE__ ) ), array(), $this->version );
    }
}