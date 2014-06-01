<?php
/**
 * Load and Initalize Public classes
 */
class Prefix_Public_Init {
    /**
     * Class Constructor
     * 
     * @param string $prefix_slug The plugin slug
     * @param string $prefix_versionThe plugin version 
     */
    public function __construct( $prefix_slug, $prefix_version) {
        // Load Library 
        $args = array(
            'included_files' => array( 'class.php', 'wrapper.php' ),
        );
        $prefix_include_files = new Prefix_Include_Files( plugin_dir_path( __FILE__ ) . 'lib', $args );
        $prefix_load_text_domain = new Prefix_Load_Text_Domain( $prefix_slug );
        //$prefix_public_styles = new Prefix_Public_Styles( $prefix_slug, $prefix_version);
        //$prefix_public_scripts = new Prefix_Public_Scripts( $prefix_slug, $prefix_version);
    }
}