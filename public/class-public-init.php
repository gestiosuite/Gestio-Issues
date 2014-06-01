<?php
/**
 * Load and Initalize Public classes
 */
class Gestio_Issues_Public_Init {
    /**
     * Class Constructor
     * 
     * @param string $gestio_issues_slug The plugin slug
     * @param string $gestio_issues_versionThe plugin version 
     */
    public function __construct( $gestio_issues_slug, $gestio_issues_version) {
        // Load Library 
        $args = array(
            'included_files' => array( 'class.php', 'wrapper.php' ),
        );
        $gestio_issues_include_files = new Gestio_Issues_Include_Files( plugin_dir_path( __FILE__ ) . 'lib', $args );
        $gestio_issues_load_text_domain = new Gestio_Issues_Load_Text_Domain( $gestio_issues_slug );
        //$gestio_issues_public_styles = new Gestio_Issues_Public_Styles( $gestio_issues_slug, $gestio_issues_version);
        //$gestio_issues_public_scripts = new Gestio_Issues_Public_Scripts( $gestio_issues_slug, $gestio_issues_version);
    }
}