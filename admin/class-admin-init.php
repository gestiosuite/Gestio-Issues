<?php
/**
 * Load and Initalize Admin classes
 */
class Prefix_Admin_Init {
    /**
     * Class Constructor
     *
     * @param string $prefix_slug The plugin slug
     * @param string $prefix_versionThe plugin version 
     */
    public function __construct($prefix_slug, $prefix_version) {
        // Load Library 
        $args = array(
            'included_files' => array( 'class.php', 'wrapper.php' ),
        );
        $prefix_include_files = new Prefix_Include_Files( plugin_dir_path( __FILE__ ) . 'lib', $args );
        //$admin_styles = new Prefix_Admin_Styles( $prefix_slug, $prefix_version);
        //$admin_styles = new Prefix_Admin_Scripts( $prefix_slug, $prefix_version);
        //$admin_menus = new Prefix_Admin_Menus( $prefix_slug, $prefix_version);
    }
}