<?php
add_filter( 'cmb_meta_boxes', 'cmb_config' );
function cmb_config( array $meta_boxes ) {
    global $gestio_issues_slug;
        $meta_boxes['column_left'] = array(
            'id'         => 'column_left',
            'title'      => __( 'Left Column', $gestio_issues_slug ),
            'pages'      => array( 'page', ), // Post type
            'context'    => 'normal',
            'priority'   => 'high',
            'show_names' => false,
            'fields'     => array(
                array(
                    'name'    => 'Left Column',
                    'id'      => $gestio_issues_slug . 'left-column',
                    'type'    => 'wysiwyg',
                    'options' => array(
                        'wpautop'       => true,
                        'media_buttons' => true,
                        'textarea_name' => '',
                        'textarea_rows' => get_option('default_post_edit_rows', 10),
                        'tabindex'      => '',
                        'editor_css'    => '',
                        'editor_class'  => '',
                        'teeny'         => false,
                        'dfw'           => false,
                        'tinymce'       => true,
                        'quicktags'     => true
                    ),
                ),
            ),
        );
    return $meta_boxes;
}