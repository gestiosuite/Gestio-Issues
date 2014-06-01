<?php
/**
 * Load the Text Domain for localization
 */
class Gestio_Issues_Load_Text_Domain {
    /**
     * Class Constructor
     *
     * @param string $gestio_issues_slug The plugin slug
     */
    public function __construct() {
        // Load plugin text domain
        add_action( 'init', array( $this, 'load_plugin_textdomain' ) );
    }
    /**
     * Load the plugin text domain for translation
     */
    public function load_plugin_textdomain() {
        load_plugin_textdomain( PREFIX_SLUG , false, plugin_dir_path( dirname( dirname( dirname( __FILE__ ) ) ) ) . 'languages' );
    }
}