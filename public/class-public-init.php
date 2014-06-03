<?php
/**
 * Load and Initalize Public classes
 *
 * @since  1.0.0
 */
class Gestio_Issues_Public_Init {
    /**
     * Class Constructor
     *
     * @since  1.0.0
     */
    public function __construct() {
        $gestio_issues_include_files = new Gestio_Issues_Include_Files( plugin_dir_path( __FILE__ ) . 'lib', array( 'class.php' ) );
        $gestio_issues_load_text_domain = new Gestio_Issues_Load_Text_Domain();
        $gestio_issues_public_scripts = new Gestio_Issues_Public_Scripts();
        $gestio_issues_public_styles = new Gestio_Issues_Public_Styles();
        $gestio_issues_post_types = new Gestio_Issues_Post_Types();
    }
}