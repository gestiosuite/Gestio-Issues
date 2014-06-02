<?php
/**
 * Create Pages on Activation
 *
 * @since 1.0.0
 */
class Gestio_Issues_Create_Pages {
    /**
     * Class Constructor
     *
     * @since  1.0.0 
     */
    public function __construct() {
        $this->ticket_page();
    }
    /**
     * Create issues table display page
     *
     * @since  1.0.0
     */
    private function ticket_page(){
        $gi_issues_page = array(
            'post_content'      => '[tickets-table]',
            'post_name'         => 'gi_issues_page',
            'post_title'        => 'Tickets',
            'post_status'       => 'publish',
            'post_type'         => 'page',
            'post_author'       => 1,
            'ping_status'       => 'closed',
            'menu_order'        => 0,
            'comment_status'    => 'closed'
        );
        $this->create_page( 'gi_issues_page' , $gi_issues_page );
    }
    /**
     * Checks against a list of currently created pages.
     * If the page doesn't exits it creates one
     *
     * @since  1.0.0
     */
    public function create_page( $slug, $args ){
        $pages = get_pages();
        $page_list = '';
        if( ! empty( $pages ) ) {
            // create an array of exisiting pages
            foreach($pages as $page){
                $page_list[] = $page->post_name;
            }
            // check if page already exists
            if( ! in_array( $slug , $page_list ) ) {
                wp_insert_post( $args );
            }
        } else {
            wp_insert_post( $args );
        }
    }
}