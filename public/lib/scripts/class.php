<?php
/**
 * Load the Public Scripts
 */
class Prefix_Public_Scripts {
    /**
     * Class Constructor
     *
     * @param string $prefix_slug The plugin slug
     * @param string $prefix_versionThe plugin version 
     */
    public function __construct( $prefix_slug, $prefix_version) {
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        $this->plugin_slug = $prefix_slug;
        $this->version = $prefix_version;
    }
    public function enqueue_scripts() {
        wp_enqueue_script( $this->plugin_slug, plugins_url( 'assets/js/public.js', dirname( __FILE__ ) ), array( 'jquery' ), $this->version, true );
    }
}