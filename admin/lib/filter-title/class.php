<?php
/**
 * Creat title from company name field
 *
 * @since  1.0.0
 */
class Gestio_Issues_Filtered_Title {
    public $the_post_type;
    /**
     * Class Constructor
     * 
     * @since     1.0.0
     */
    public function __construct() {
        add_action('save_post', array( $this, 'tickets_post_title'), 12 );
        $this->the_post_type = 'gi_tickets';
    }
    /**
     * Tickets Title
     * 
     * Create a title for the post using the company's name meta and the published date
     * 
     * @param  int $post_id the post's ID
     * @since  1.0.0
     */
    public function tickets_post_title ($post_id) {
        global $post; 
        if ( $post_id == null || empty($_POST) ) {
            return;
        }
        if ( !isset( $_POST['post_type'] ) || $_POST['post_type'] != $this->the_post_type ) {  
            return; 
        }
        if ( wp_is_post_revision( $post_id ) ) {
            $post_id = wp_is_post_revision( $post_id );
        }
        if ( empty( $post ) ) {
            $post = get_post($post_id);
        }
        if ( $_POST['gestio_issues_company_name'] != '' ) {
            global $wpdb;
            $the_date = get_the_date( 'F j, Y' );
            $the_time = get_the_time( 'g:i:s A' );
            $title = $_POST['gestio_issues_company_name'] . ' - ' . $the_date . ' ' .  $the_time;
            $where = array( 'ID' => $post_id );
            $wpdb->update( $wpdb->posts, array( 'post_title' => $title ), $where );
        }
    }
}