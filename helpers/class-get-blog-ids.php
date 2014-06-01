<?php
/**
 * Get the blogs ID's
 */
class Gestio_Issues_Get_Blog_IDs {
    /**
     * Class Constructor
     */
    public function __construct() {
    }
    /**
     * Get all blog ids of blogs in the current network
     */
    public static function get_blog_ids() {
        global $wpdb;
        // get an array of blog ids
        $sql = "SELECT blog_id FROM $wpdb->blogs
            WHERE archived = '0' AND spam = '0'
            AND deleted = '0'";
        return $wpdb->get_col( $sql );

    }
}