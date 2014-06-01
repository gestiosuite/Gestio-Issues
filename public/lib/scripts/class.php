<?php
/**
 * Load the Public Scripts
 */
class Gestio_Issues_Public_Scripts {
    /**
     * Class Constructor
     *
     * @param string $gestio_issues_slug The plugin slug
     * @param string $gestio_issues_versionThe plugin version 
     */
    public function __construct( $gestio_issues_slug, $gestio_issues_version) {
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        $this->plugin_slug = $gestio_issues_slug;
        $this->version = $gestio_issues_version;
    }
    public function enqueue_scripts() {
        wp_enqueue_script( $this->plugin_slug, plugins_url( 'assets/js/public.js', dirname( __FILE__ ) ), array( 'jquery' ), $this->version, true );
    }
}