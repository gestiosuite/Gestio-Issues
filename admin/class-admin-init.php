<?php
/**
 * Load and Initalize Admin classes
 *
 * @since  1.0.0
 */
class Gestio_Issues_Admin_Init extends Gestio_Issues_Singleton {
    /**
     * Class Constructor
     *
     * @since  1.0.0
     */
    protected function __construct() {
        $gestio_issues_include_files = new Gestio_Issues_Include_Files( plugin_dir_path( __FILE__ ) . 'lib', array( 'class.php' ) );
        Gestio_Issues_Admin_Styles::get_instance();
        Gestio_Issues_Admin_Scripts::get_instance();
    }
}