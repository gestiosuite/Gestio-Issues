<?php
/**
 * Plugin Name:       Gestio Issues
 * Plugin URI:        @TODO
 * Description:       An issue tracking system for the Gestio Managment Suite
 * Version:           0.0.1
 * Author:            Jason Witt
 * Author URI:        @TODO
 * Text Domain:       gestio-issues
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/gestiosuite/Gestio-Issues
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
class Pligin_Name_Init {
    /**
     * Class Constructor
     */
    public function __construct() {
        // Required Files
        foreach( glob( plugin_dir_path( __FILE__ ) . 'helpers/*.php' ) as $files ){
            require_once( $files );
        }
        // Register Activation and Deactivation Hook
        register_activation_hook( __FILE__, array( 'Prefix_Activate', 'activate' ) );
        register_deactivation_hook( __FILE__, array( 'Prefix_Deactivate', 'deactivate' ) );
        // Custom Post Types
        // $test = new Prefix_Custom_Post_Type('test');
        // $test->register_taxonomy('Test Taxonomy');
        // Load Admin Files
        if( is_admin() ) {
            require_once( plugin_dir_path( __FILE__ ) . 'admin/class-admin-init.php' );
            $admin_init = new Prefix_Admin_Init( PREFIX_SLUG, PREFIX_VERSION );
        }
        // Load Public Files
        require_once( plugin_dir_path( __FILE__ ) . 'public/class-public-init.php' );
        $public_init = new Prefix_Public_Init( PREFIX_SLUG, PREFIX_VERSION );
        }
    }
    
}
$plugin_name_init = new Pligin_Name_Init();