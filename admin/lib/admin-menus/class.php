<?php
/**
 * Create the Admin menu
 */
class Prefix_Admin_Menus {
    /**
     * Class Constructor
     *
     * @param string $prefix_slug The plugin slug
     * @param string $prefix_versionThe plugin version 
     */
    public function __construct($prefix_slug, $prefix_version) {
        $this->plugin_slug = $prefix_slug;
        $this->version = $prefix_version;
        add_action( 'admin_menu', array( $this, 'add_FT_admin_menu' ) );
    }
    /**
     * The menu item for displaying the functionality details
     */
    public function add_FT_admin_menu() {
        $this->plugin_screen_hook_suffix = add_submenu_page( 
            'tools.php',
            __( 'Functionality', $this->plugin_slug ),
            __( 'Functionality', $this->plugin_slug ),
            'manage_options', 
            $this->plugin_slug, 
            array( $this, 'display_FT_admin_page' )
        );

    }
    /**
     * Render the page
     */
    public function display_FT_admin_page() {
        include( plugin_dir_path( __FILE__ ) . '../views/menu-page.php' );
    }
}