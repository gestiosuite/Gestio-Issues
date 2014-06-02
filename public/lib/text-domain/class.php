<?php
/**
 * Load the Text Domain for localization
 *
 * @since  1.0.0
 */
class Gestio_Issues_Load_Text_Domain {
    /**
     * Class Constructor
     *
     * @since  1.0.0
     */
    public function __construct() {
        // Load plugin text domain
        add_action( 'init', array( $this, 'load_plugin_textdomain' ) );
    }
    /**
     * Load the plugin text domain for translation
     *
     * @since  1.0.0
     */
    public function load_plugin_textdomain() {
        load_plugin_textdomain( GESTIO_ISSUES_SLUG , false, plugin_dir_path( dirname( dirname( dirname( __FILE__ ) ) ) ) . 'languages' );
    }
}