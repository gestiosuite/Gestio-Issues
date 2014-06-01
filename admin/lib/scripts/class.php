<?php
/**
 * Load the Admin scripts
 */
class Gestio_Issues_Admin_Scripts {
    /**
     * Class Constructor
     *
     * @param string $gestio_issues_slug The plugin slug
     * @param string $gestio_issues_versionThe plugin version 
     */
    public function __construct( $gestio_issues_slug, $gestio_issues_version) {
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles' ) );
        $this->plugin_slug = $gestio_issues_slug;
        $this->version = $gestio_issues_version;
    }
    /**
     * Scripts for the Functionlity Settings page
     */
    public function enqueue_styles( $hook ) {
        if( $hook == 'tools_page_' . $this->plugin_slug ) {
            wp_enqueue_script( $this->plugin_slug, plugins_url( 'assets/js/admin.js', dirname( __FILE__ ) ), array( 'jquery' ), $this->version, true );
        }
    }
}