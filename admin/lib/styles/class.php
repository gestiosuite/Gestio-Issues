<?php
/**
 * Load the Admin Styles
 */
class Prefix_Admin_Styles {
    /**
     * Class Constructor
     *
     * @param string $prefix_slug The plugin slug
     * @param string $prefix_versionThe plugin version 
     */
    public function __construct( $prefix_slug, $prefix_version) {
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles' ) );
        $this->plugin_slug = $prefix_slug;
        $this->version = $prefix_version;
    }
    /**
     * Styles for the Functionlity Settings page
     */
    public function enqueue_styles( $hook ) {
        if( $hook == 'tools_page_' . $this->plugin_slug ) {
            wp_enqueue_style( $this->plugin_slug, plugins_url( 'assets/css/admin.css', dirname( __FILE__ ) ), array(), $this->version );
        }
    }
}