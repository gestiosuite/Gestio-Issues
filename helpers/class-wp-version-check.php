<?php
/**
 * Check the version of WordPress
 *
 * @since  1.0.0
 */
class Gestio_Issues_WP_Version_Check {
    static $version;
    /**
     * The primary sanity check, automatically disable the plugin on activation if it doesn't meet minimum requirements
     *
     * @since  1.0.0
     */
    public static function activation_check( $version ) {
        self::$version = $version;
        if ( ! self::compatible_version() ) {
            deactivate_plugins( plugin_basename( __FILE__ ) );
            wp_die( __( GESTIO_ISSUES_PLUGIN_NAME . ' requires WordPress ' . self::$version . ' or higher!', GESTIO_ISSUES_SLUG ) );
        } 
    }
    /**
     * The backup sanity check, in case the plugin is activated in a weird way, or the versions change after activation
     *
     * @since  1.0.0
     */
    public function check_version() {
        if ( ! self::compatible_version() ) {
            if ( is_plugin_active( plugin_basename( __FILE__ ) ) ) {
                deactivate_plugins( plugin_basename( __FILE__ ) );
                add_action( 'admin_notices', array( $this, GESTIO_ISSUES_SLUG ) );
                if ( isset( $_GET['activate'] ) ) {
                    unset( $_GET['activate'] );
                }
            } 
        } 
    }
    /**
     * Text to display in the notice
     *
     * @since  1.0.0
     */
    public function disabled_notice() {
       echo '<strong>' . esc_html__( GESTIO_ISSUES_PLUGIN_NAME . ' requires WordPress ' . self::$version . ' or higher!', GESTIO_ISSUES_SLUG ) . '</strong>';
    } 
    /**
     * Check current version against $prefix_version_check
     *
     * @since  1.0.0
     */
    public static function compatible_version() {
        if ( version_compare( $GLOBALS['wp_version'], self::$version, '<' ) ) {
             return false;
         }
        return true;
    }
}