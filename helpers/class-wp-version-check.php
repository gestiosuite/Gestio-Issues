<?php
/**
 * Check the version of WordPress
 */
class Prefix_WP_Version_Check {
    static $version;
    public static $name = 'This plugin';
    public static $slug = 'prefix-functionality';
    /**
     * The primary sanity check, automatically disable the plugin on activation if it doesn't meet minimum requirements
     */
    public static function activation_check( $version ) {
        self::$version = $version;
        if ( ! self::compatible_version() ) {
            deactivate_plugins( plugin_basename( __FILE__ ) );
            wp_die( __( self::$name . ' requires WordPress ' . self::$version . ' or higher!', self::$slug ) );
        } 
    }
    /**
     * The backup sanity check, in case the plugin is activated in a weird way, or the versions change after activation
     */
    public function check_version() {
        if ( ! self::compatible_version() ) {
            if ( is_plugin_active( plugin_basename( __FILE__ ) ) ) {
                deactivate_plugins( plugin_basename( __FILE__ ) );
                add_action( 'admin_notices', array( $this, self::$slug ) );
                if ( isset( $_GET['activate'] ) ) {
                    unset( $_GET['activate'] );
                }
            } 
        } 
    }
    /**
     * Text to display in the notice
     */
    public function disabled_notice() {
       echo '<strong>' . esc_html__( self::$name . ' requires WordPress ' . self::$version . ' or higher!', self::$slug ) . '</strong>';
    } 
    /**
     * Check current version against $prefix_version_check
     */
    public static function compatible_version() {
        if ( version_compare( $GLOBALS['wp_version'], self::$version, '<' ) ) {
             return false;
         }
        return true;
    }
}