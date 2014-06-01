<?php
/**
 * Run on Deactivation
 */
class Gestio_Issues_Deactivate {
    /**
     * Class Constructor
     */
    public function __construct() {
    }
    /**
     * Fired when the plugin is deactivated
     *
     * @param boolean $network_wide True if WPMU superadmin uses "Network Deactivate" action, false if WPMU is disabled or plugin is deactivated on an individual blog.
     */
    public static function deactivate( $network_wide ) {
        if ( function_exists( 'is_multisite' ) && is_multisite() ) {
            if ( $network_wide ) {
                // Get all blog ids
                $blog_ids = Gestio_Issues_Get_Blog_IDs::get_blog_ids();
                foreach ( $blog_ids as $blog_id ) {
                    switch_to_blog( $blog_id );
                    self::single_deactivate();
                }
                restore_current_blog();
            } else {
                self::single_deactivate();
            }
        } else {
            self::single_deactivate();
        }
    }
    /**
     * Fired for each blog when the plugin is deactivated
     */
    private static function single_deactivate() {
        self::flush_rewrite_rules();
    }
    /**
     * Flush rewrite rules for new Custom Post Types
     */
    public static function flush_rewrite_rules() {
        flush_rewrite_rules( false );
    }
}
