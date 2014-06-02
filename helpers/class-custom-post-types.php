<?php
/**
 * Creat Custom Post Types
 *
 * @since  1.0.0
 */
class Gestio_Issues_Custom_Post_Type {
    protected $post_type_name;
    protected $post_type_labels;
    protected $post_type_args;
    /**
     * Class Constructor
     *
     * @since  1.0.0
     */
    public function __construct( $name, $labels = array(), $args = array() ) {
        $this->post_type_name   = trim( strtolower( str_replace( ' ', '_', $name ) ) );
        $this->post_type_labels = $labels;
        $this->post_type_args   = $args;
        // If plugin is activated
        if( ! post_type_exists( $this->post_type_name ) ) {
            register_activation_hook( __FILE__, 'flush_rewrite_rules' );
            add_action( 'init', array( $this, 'register_post_type' ) );
        }
    }
    /**
     * Flush rerwite rules on plugin activation
     *
     * @since  1.0.0
     */
    public static function flush_rewrite_rules() {
        flush_rewrite_rules( false );
    }
    /**
     * The post type labels. User defined labels override the default
     * @return array The modified array of post type labels
     *
     * @since  1.0.0
     */
    private function post_type_labels() {
        $singular = str_replace( '_', ' ', ucwords( $this->post_type_name ) );
        $plural = self::pluralize( $singular );
        $defaults = array( 
            'name'                  => _x( $plural, 'post type general name' ),
            'singular_name'         => _x( $singular, 'post type singular name' ),
            'add_new'               => __( 'Add New' ),
            'all_items'             => __( 'All ' . $plural ),
            'add_new_item'          => __( 'Add New ' . $singular ),
            'edit_item'             => __( 'Edit ' . $singular ),
            'new_item'              => __( 'New ' . $singular ),
            'view_item'             => __( 'View ' . $singular ),
            'search_items'          => __( 'Search ' . $plural ),
            'not_found'             => __( 'No ' . $plural . ' Found'),
            'not_found_in_trash'    => __( 'No ' . $plural . ' Found in Trash'),
            'parent_item_colon'     => __( 'Parent ' . $singular . ' Post:'),
            'menu_name'             => __( $plural ),
        );
        $args   = $this->post_type_labels;
        $labels = array_merge( $defaults, $args );
        return $labels;
    }
    /**
     * The post type arguments. User defined arguments override the default
     * @return array The modified array of post type arguments
     *
     * @since  1.0.0
     */
    private function post_type_args() {
        $labels   = $this->post_type_labels();
        $defaults = array(
            'labels'                => $labels,
            'description'           => '',
            'public'                => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'show_ui'               => true,
            'show_in_nav_menus'     => true,
            'show_in_menu'          => true,
            'show_in_admin_bar'     => true,
            'menu_position'         => NULL,
            'menu_icon'             => NULL,
            'capability_type'       => 'post',
            'capabilities'          => array(   
                                            'edit_post', 
                                            'read_post', 
                                            'delete_post',
                                            'edit_posts',
                                            'edit_others_posts',
                                            'publish_posts',
                                            'read_private_posts'
                                        ),
            'map_meta_cap'          => true,
            'hierarchical'          => false,
            'supports'              => array(   
                                            'title',
                                            'editor'
                                        ),
            'register_meta_box_cb'  => '',
            'taxonomies'            => array(),
            'has_archive'           => false,
            'permalink_epmask'      => EP_PERMALINK,
            'rewrite'               => array( 'slug'=> $this->post_type_name ),
            'query_var'             => true,
            'can_export'            => true,
            '_builtin'              => false
        );
        $arguments = $this->post_type_args;
        $args = array_merge( $defaults, $arguments );
        return $args;
    }
    /**
     * Register Post Type
     *
     * @since  1.0.0
     */
    public function register_post_type() {
        register_post_type( $this->post_type_name, $this->post_type_args() );
    }
    /**
     * The taxonomy labels. User defined labels override the default
     * 
     * @param  string $taxonomy_name   The taxonomy name
     * @param  array  $taxonomy_labels array of taxomony labels
     * @return array  The modified array of taxomony labels
     * @since  1.0.0
     */
    private function taxonomy_labels(  $taxonomy_name, $taxonomy_labels = array() ) {
        $singular = str_replace( '_', ' ', ucwords( $taxonomy_name ) );
        $plural   = self::pluralize( $singular );
        $defaults = array(
            'name'                          => _x( $plural, 'taxonomy general name' ),
            'singular_name'                 => _x( $singular, 'taxonomy singular name' ),
            'all_items'                     => __( 'All ' . $plural ),
            'edit_item'                     => __( 'Edit ' . $plural ), 
            'view_item'                     => __( 'View ' . $singular ),
            'update_item'                   => __( 'Update ' . $plural ),
            'add_new_item'                  => __( 'Add New ' . $singular ),
            'new_item_name'                 => __( 'New ' . $singular ),
            'parent_item'                   => __( 'Parent ' . $singular ),
            'parent_item_colon'             => __( 'Parent ' . $singular ),
            'search_items'                  => __( 'Search ' . $plural ),
            'popular_items'                 => __( 'Popular ' . $plural),
            'separate_items_with_commas'    => __( 'Separate ' . $plural . ' with commas' ),
            'add_or_remove_items'           => __( 'Add or Remove ' . $singular ),
            'choose_from_most_used'         => __( 'Choose from the most used ' . $plural ),
            'not_found'                     =>  __( 'No ' . $plural . ' found.' ),
            'menu_name'                     => __(  $plural ),
        );
        $args   = $taxonomy_labels;
        $labels = array_merge( $defaults, $args );
        return $labels;
    }
    /**
     * The taxonomy arguments. User defined arguments override the default
     * 
     * @param  string $taxonomy_name   The taxonomy name
     * @param  array  $taxonomy_labels array of taxomony labels
     * @param  array  $taxonomy_args   array of taxomony arguments
     * @return array  The modified array of taxomony arguments
     * @since  1.0.0
     */
    private function taxanomy_args( $taxonomy_name, $taxonomy_labels = array(), $taxonomy_args = array() ) {
        $defaults = array( 
            'labels'                => $taxonomy_labels,
            'public'                => true,
            'show_ui'               => true,
            'show_in_nav_menus'     => true,
            'show_tagcloud'         => false,
            'meta_box_cb'           => NULL,
            'show_admin_column'     => false,
            'hierarchical'          => true,
            'update_count_callback' => '',
            'query_var'             => $taxonomy_name,
            'sort'                  => '',
            'rewrite'               => array( 'slug' => $taxonomy_name ),
            'capabilities'          => array()
        );
        $arguments = $taxonomy_args;
        $args      = array_merge( $defaults, $arguments );
        return $args;
    }
    /**
     * Register taxonomies
     * 
     * @param  string $name   The taxonomy name
     * @param  array  $args   User defined arguments
     * @param  array  $labels User defined labels
     * @since  1.0.0
     */
    public function register_taxonomy( $name, $args = array(), $labels = array() ) {
         if( ! empty( $name ) ) {
            $post_type_name  = $this->post_type_name;
            $taxonomy_name   = trim( strtolower( str_replace( ' ', '_', $name ) ) );
            $taxonomy_labels = $labels;
            $taxonomy_args   = $args;
            if( ! taxonomy_exists( $taxonomy_name ) ) {
                $label_args = $this->taxonomy_labels( $taxonomy_name, $taxonomy_labels );
                $tax_args   = $this->taxanomy_args( $taxonomy_name, $label_args, $taxonomy_args );
                add_action( 'init', function() use( $taxonomy_name, $post_type_name, $tax_args ) { register_taxonomy( $taxonomy_name, $post_type_name, $tax_args ); } );
            } else {
                add_action( 'init', function() use( $taxonomy_name, $post_type_name ) { register_taxonomy_for_object_type( $taxonomy_name, $post_type_name ); } );
            }
        }
    }
    /**
     * Pluralize the post type or taxonomy name
     * 
     * @param  string $word The name of the post type or taxonomy
     * @return string         The pluralized verion of the post type or taxonomy name
     * @see  https://github.com/whiteoctober/RestBundle/blob/master/Pluralization/Pluralization.php
     * @since  1.0.0
     */
    public static function pluralize( $word ) {
       $plurals = array(
            '/(quiz)$/i'                => '\1zes',
            '/^(ox)$/i'                 => '\1en',
            '/([m|l])ouse$/i'           => '\1ice',
            '/(matr|vert|ind)ix|ex$/i'  => '\1ices',
            '/(x|ch|ss|sh)$/i'          => '\1es',
            '/([^aeiouy]|qu)ies$/i'     => '\1y',
            '/([^aeiouy]|qu)y$/i'       => '\1ies',
            '/(hive)$/i'                => '\1s',
            '/(?:([^f])fe|([lr])f)$/i'  => '\1\2ves',
            '/sis$/i'                   => 'ses',
            '/([ti])um$/i'              => '\1a',
            '/(buffal|tomat)o$/i'       => '\1oes',
            '/(bu)s$/i'                 => '\1ses',
            '/(alias|status)/i'         => '\1es',
            '/(octop|vir)us$/i'         => '\1i',
            '/(ax|test)is$/i'           => '\1es',
            '/s$/i'                     => 's',
            '/$/'                       => 's'
        );
        $uncountables = array(
            'equipment', 'information', 'rice', 'money', 'species', 'series', 'fish', 'sheep'
        );
        $irregulars = array(
            'person'  => 'people',
            'man'     => 'men',
            'child'   => 'children',
            'sex'     => 'sexes',
            'move'    => 'moves'
        );
        $lowerCasedWord = strtolower($word);
        foreach ($uncountables as $uncountable) {
            if(substr($lowerCasedWord, (-1 * strlen($uncountable))) == $uncountable) {
                return $word;
            }
        }
        foreach ($irregulars as $plural => $singular) {
            if (preg_match('/(' . $plural . ')$/i', $word, $arr)) {
                return preg_replace(
                    '/(' . $plural . ')$/i',
                    substr($arr[0], 0, 1) . substr($singular, 1),
                    $word
                );
            }
        }
        foreach ($plurals as $rule => $replacement) {
            if (preg_match($rule, $word)) {
                return preg_replace($rule, $replacement, $word);
            }
        }
        return false;
    }
}