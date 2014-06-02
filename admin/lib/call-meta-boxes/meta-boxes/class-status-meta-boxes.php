<?php
/**
 * Custom Meta Boxes - Status
 *
 * @since  1.0.0
 */
class Gestio_Issues_Status_Meta_Boxes {
    /**
     * Class Constructor
     * 
     * @since     1.0.0
     */
    public function __construct() {
        add_action('add_meta_boxes', array( $this, 'meta_boxes' ) );
        add_action( 'save_post', array( $this, 'save_post' ) );
    }
    /**
     * Add the meta box
     * 
     * @param  string $post_type the post type
     * @since  1.0.0
     */
    public function meta_boxes( $post_type ) {
        $post_types = array( 'gi_tickets' );
        if ( in_array( $post_type, $post_types )) {
            add_meta_box(
                'gestio_issues_status_fields',
                __('Status', GESTIO_ISSUES_SLUG),
                array( $this, 'display_status_meta_boxes' ),
                $post_type,
                'side',
                'default'
            );
        }
    }
    /**
     * Callbck for displaying the meta fields
     * 
     * @param  mixed $post the post object
     * @since  1.0.0
     */
    public function display_status_meta_boxes( $post ) {
        $ticket_status_value = get_post_meta( $post->ID, 'gestio_issues_ticket_status', true );
        echo '<div class="meta-fields">
                <p class="label">
                    <span class="radio-label">'. __( 'Ticket Status', GESTIO_ISSUES_SLUG ) .'</span>
                </p>
                <ul class="fields-list">
                    <li class="horizontal">
                        <input type="radio" name="gestio_issues_ticket_status" id="gestio_issues_ticket_status_open" value="open" '. ( isset( $ticket_status_value ) ? checked( $ticket_status_value, "website", false ) : "" ).' checked/>
                        <label for="gestio_issues_ticket_status_website">' . __( 'Open', GESTIO_ISSUES_SLUG ) . '</label>
                    </li>
                    <li class="horizontal">
                        <input type="radio" name="gestio_issues_ticket_status" id="gestio_issues_ticket_status_closed" value="closed" '. ( isset( $ticket_status_value ) ? checked( $ticket_status_value, "feature", false ) : "" ).' />
                        <label for="gestio_issues_ticket_status_feature">' . __( 'Closed', GESTIO_ISSUES_SLUG ) . '</label>
                    </li>
                </ul>
            </div>';
        wp_nonce_field( plugins_url(__FILE__), 'gestio_issues_tickets_status_nonce' );
    }
    /**
     * Save the meta when the post is saved.
     *
     * @param int $post_id The ID of the post being saved.
     */
    public function save_post( $post_id ) {
        if ( ! isset( $_POST['gestio_issues_tickets_status_nonce'] ) ) {
            return $post_id;
        }
        if ( ! wp_verify_nonce( $_POST['gestio_issues_tickets_status_nonce'], plugins_url(__FILE__) ) ) {
            return $post_id;
        }
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $post_id;
        }
        if ( 'tickets' == $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return $post_id;
            }
        } else {
            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return $post_id;
            }
        }
        if( isset( $_POST['gestio_issues_ticket_status'] ) ) {
            update_post_meta( $post_id, 'gestio_issues_ticket_status', $_POST['gestio_issues_ticket_status'] );
        }
    }
}