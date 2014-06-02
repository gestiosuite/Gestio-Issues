<?php
/**
 * Delete Pages on Activation
 *
 * @since 1.0.0
 */
class Gestio_Issues_Delete_Pages {
    public $page_array;
    /**
     * Class Constructor
     *
     * @since  1.0.0 
     */
    public function __construct() {
        $this->page_array = array(
            'gi_issues_page'
        );
        $this->delete_page( $this->page_array );
    }
    /**
     * Checks against a list of currently created pages.
     * If the page exists delete it
     *
     * @since  1.0.0
     */
    public function delete_page(){
        global $page;
        $page_id = '';
        foreach( $this->page_array as $page ){
            $exists = get_page_by_path( $page );
            if ( $exists ) {
                $page_id = $exists->ID;
            }
            wp_delete_post( $page_id, true );
        }
    }
}