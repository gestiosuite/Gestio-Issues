<?php
/**
 * Load the Public styles
 */
class Gestio_Issues_Public_Styles {
    /**
     * Class Constructor
     *
     * @param string $gestio_issues_slug The plugin slug
     * @param string $gestio_issues_versionThe plugin version 
     */
    public function __construct( $gestio_issues_slug, $gestio_issues_version) {
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
        $this->plugin_slug = $gestio_issues_slug;
        $this->version = $gestio_issues_version;
    }
    public function enqueue_styles() {
        wp_enqueue_style( $this->plugin_slug, plugins_url( 'assets/css/public.css', dirname( __FILE__ ) ), array(), $this->version );
    }
}