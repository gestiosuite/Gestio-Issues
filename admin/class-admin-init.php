<?php
/**
 * Load and Initalize Admin classes
 */
class Gestio_Issues_Admin_Init {
    /**
     * Class Constructor
     *
     * @param string $gestio_issues_slug The plugin slug
     * @param string $gestio_issues_versionThe plugin version 
     */
    public function __construct($gestio_issues_slug, $gestio_issues_version) {
        // Load Library 
        $args = array(
            'included_files' => array( 'class.php', 'wrapper.php' ),
        );
        $gestio_issues_include_files = new Gestio_Issues_Include_Files( plugin_dir_path( __FILE__ ) . 'lib', $args );
        //$admin_styles = new Gestio_Issues_Admin_Styles( $gestio_issues_slug, $gestio_issues_version);
        //$admin_styles = new Gestio_Issues_Admin_Scripts( $gestio_issues_slug, $gestio_issues_version);
        //$admin_menus = new Gestio_Issues_Admin_Menus( $gestio_issues_slug, $gestio_issues_version);
    }
}