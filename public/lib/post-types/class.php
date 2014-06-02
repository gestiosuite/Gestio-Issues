<?php
/**
 * Register Post Types
 *
 * @since  1.0.0
 */
class Gestio_Issues_Post_Types {
    /**
     * Class Constructor
     *
     * @since  1.0.0 
     */
    public function __construct() {
        $this->tickets_post_type();
    }
    public function tickets_post_type(){
        $tickets_cpt_lables = array( 
            'name'                  => 'Tickets',
            'singular_name'         => 'Ticket',
            'add_new'               => 'Add New',
            'all_items'             => 'All Tickets',
            'add_new_item'          => 'Add New Ticket',
            'edit_item'             => 'Edit Ticket',
            'new_item'              => 'New Ticket',
            'view_item'             => 'View Ticket',
            'search_items'          => 'Search Tickets',
            'not_found'             => 'No Tickets Found',
            'not_found_in_trash'    => 'No Tickets Found in Trash',
            'parent_item_colon'     => 'Parent Ticket Post:',
            'menu_name'             => 'Tickets',
        );
        $tickets_cpt_args = array(
            'supports'              => array( 'gestio_issues_company_name', 'title' ),
        );
        $tickets_cpt = new Gestio_Issues_Custom_Post_Type('GI Tickets',  $tickets_cpt_lables, $tickets_cpt_args );
    }
}