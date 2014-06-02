<?php
/**
 * Custom Meta Boxes - Tickets
 *
 * @since  1.0.0
 */
class Gestio_Issues_Tickets_Meta_Boxes {
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
                'gestio_issues_tickets_fields',
                __('Ticket', GESTIO_ISSUES_SLUG),
                array( $this, 'display_tickets_meta_boxes' ),
                $post_type,
                'normal',
                'high'
            );
        }
    }
    /**
     * Callbck for displaying the meta fields
     * 
     * @param  mixed $post the post object
     * @since  1.0.0
     */
    public function display_tickets_meta_boxes( $post ) {
        $ticket_type_value = get_post_meta( $post->ID, 'gestio_issues_ticket_type', true );
        echo '<div class="meta-fields right" style="background: none;">
                <p class="label">
                    <span class="radio-label">'. __( 'Ticket Type', GESTIO_ISSUES_SLUG ) .'</span>
                </p>
                <ul class="fields-list horizontal">
                    <li class="horizontal">
                        <label for="gestio_issues_ticket_type_website">' . __( 'Website Issue', GESTIO_ISSUES_SLUG ) . '</label>
                        <input type="radio" name="gestio_issues_ticket_type" id="gestio_issues_ticket_type_website" value="website" '. ( isset( $ticket_type_value ) ? checked( $ticket_type_value, "website", false ) : "" ).' checked/>
                    </li>
                    <li class="horizontal">
                        <label for="gestio_issues_ticket_type_feature">' . __( 'Feature Request', GESTIO_ISSUES_SLUG ) . '</label>
                        <input type="radio" name="gestio_issues_ticket_type" id="gestio_issues_ticket_type_feature" value="feature" '. ( isset( $ticket_type_value ) ? checked( $ticket_type_value, "feature", false ) : "" ).' />
                    </li>
                    <li class="horizontal">
                        <label for="gestio_issues_ticket_type_feature">' . __( 'Other', GESTIO_ISSUES_SLUG ) . '</label>
                        <input type="radio" name="gestio_issues_ticket_type" id="gestio_issues_ticket_type_other" value="other" '. ( isset( $ticket_type_value ) ? checked( $ticket_type_value, "other", false ) : "" ).' />
                    </li>
                </ul>
            </div>';
        echo '<div class="meta-fields">
                <p class="label">
                    <label for="post_title">'. __( 'Company\'s Name', GESTIO_ISSUES_SLUG ) .'</label></br>
                    <input type="text" name="post_title" id="post_title" value="'.  esc_attr( get_post_meta( $post->ID, 'post_title', true ) ) .'" />
                </p>
                <p class="label">
                    <label for="gestio_issues_contact_name">'. __( 'Contact\'s Name', GESTIO_ISSUES_SLUG ) .'</label></br>
                    <input type="text" name="gestio_issues_contact_name" id="gestio_issues_contact_name" value="'. esc_attr( get_post_meta( $post->ID, 'gestio_issues_contact_name', true ) ) .'" />
                </p>
               
            </div>';
         echo '<div class="meta-fields">
                <p class="label">
                    <label for="gestio_issues_contact_email">'. __( 'Contact\'s Email Address', GESTIO_ISSUES_SLUG ) .'</label></br>
                    <input type="text" name="gestio_issues_contact_email" id="gestio_issues_contact_email" value="'. esc_attr( get_post_meta( $post->ID, 'gestio_issues_contact_email', true ) ) .'" />
                </p>
                <p class="label">
                    <label for="gestio_issues_website_url">'. __( 'The Website\'s URL', GESTIO_ISSUES_SLUG ) .'</label></br>
                    <input type="text" name="gestio_issues_website_url" id="gestio_issues_website_url" value="'. esc_attr( get_post_meta( $post->ID, 'gestio_issues_website_url', true ) ) .'" />
                </p>
            </div>';;
        echo '<div class="meta-fields">
                <p class="label">
                    <label for="gestio_issues_short_description">'. __( 'The Short Description', GESTIO_ISSUES_SLUG ) .'</label></br>
                </p>
                   <textarea name="gestio_issues_short_description" id="gestio_issues_short_description">'. esc_textarea( get_post_meta( $post->ID, 'gestio_issues_ticket_message', true ) ) .'</textarea>
            </div>';
        echo '<div class="meta-fields message">
                <p class="label">
                    <label for="gestio_issues_ticket_message">'. __( 'The Message', GESTIO_ISSUES_SLUG ) .'</label></br>
                </p>
                   <textarea name="gestio_issues_ticket_message" id="gestio_issues_ticket_message">'. esc_textarea( get_post_meta( $post->ID, 'gestio_issues_ticket_message', true ) ) .'</textarea>
            </div>';

        wp_nonce_field( plugins_url(__FILE__), 'gestio_issues_tickets_fields_nonce' );
    }
    /**
     * Save the meta when the post is saved.
     *
     * @param int $post_id The ID of the post being saved.
     */
    public function save_post( $post_id ) {
        if ( ! isset( $_POST['gestio_issues_tickets_fields_nonce'] ) ) {
            return $post_id;
        }
        if ( ! wp_verify_nonce( $_POST['gestio_issues_tickets_fields_nonce'], plugins_url(__FILE__) ) ) {
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
        if( isset( $_POST['gestio_issues_ticket_type'] ) ) {
            update_post_meta( $post_id, 'gestio_issues_ticket_type', $_POST['gestio_issues_ticket_type'] );
        }
        if( isset( $_POST['post_title'] ) ) {
            update_post_meta( $post_id, 'post_title', sanitize_text_field( $_POST['post_title'] ) );
        }
        if( isset( $_POST['gestio_issues_contact_name'] ) ){
            update_post_meta( $post_id, 'gestio_issues_contact_name', sanitize_text_field( $_POST['gestio_issues_contact_name'] ) );
        }
        if( isset( $_POST['gestio_issues_website_url'] ) ) {
            update_post_meta( $post_id, 'gestio_issues_website_url', esc_url_raw( $_POST['gestio_issues_website_url'] ) );
        }
        if( isset( $_POST['gestio_issues_contact_email'] ) ) {
            update_post_meta( $post_id, 'gestio_issues_contact_email', is_email( $_POST['gestio_issues_contact_email'] ) );
        }
        if( isset( $_POST['gestio_issues_short_description'] ) ){
            update_post_meta( $post_id, 'gestio_issues_short_description', sanitize_text_field( $_POST['gestio_issues_short_description'] ) );
        }
        if( isset( $_POST['gestio_issues_ticket_message'] ) ) {
            update_post_meta( $post_id, 'gestio_issues_ticket_message', sanitize_text_field( $_POST['gestio_issues_ticket_message'] ) );
        }
        
    }
}