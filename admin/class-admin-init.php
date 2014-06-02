<?php
/**
 * Load and Initalize Admin classes
 *
 * @since  1.0.0
 */
class Gestio_Issues_Admin_Init {
    /**
     * Class Constructor
     *
     * @since  1.0.0
     */
    public function __construct() {
        $gestio_issues_include_files = new Gestio_Issues_Include_Files( plugin_dir_path( __FILE__ ) . 'lib', array( 'class.php' ) );
        $gestio_issues_admin_styles = new Gestio_Issues_Admin_Styles();
        $gestio_issues_admin_scripts = new Gestio_Issues_Admin_Scripts();
    }
}