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

/**
 * Class to initiate the plugin
 *
 * @since  1.0.0
 */
class Gestio_Issues_Init {
    private static $instance = null;
    /**
     * Creates or returns an instance of this class.
     *
     * @return  Foo A single instance of this class.
     */
    public static function get_instance() {
        if ( null == self::$instance ) {
            self::$instance = new self;
        }
        return self::$instance;
    }
    /**
     * Class Constructor
     *
     * @since  1.0.0
     */
    private function __construct() {
        $this->load_files();
        register_activation_hook( __FILE__, array( 'Gestio_Issues_Activate', 'activate' ) );
        register_deactivation_hook( __FILE__, array( 'Gestio_Issues_Deactivate', 'deactivate' ) );
        $this->admin_init();
        $this->public_init();
        $string = 'Gestio Issues Tickets';
    }
    public function load_files(){
        foreach( glob( plugin_dir_path( __FILE__ ) . 'helpers/*.php' ) as $files ){
            require_once( $files );
        }
    }
    /**
     * Admin init
     *
     * @since  1.0.0
     */
    public function admin_init(){
        if( is_admin() ) {
            require_once( plugin_dir_path( __FILE__ ) . 'admin/class-admin-init.php' );
            $gestio_issues_admin_init = new Gestio_Issues_Admin_Init();
        }
    }
    /**
     * Public init
     *
     * @since  1.0.0
     */
    public function public_init(){
        require_once( plugin_dir_path( __FILE__ ) . 'public/class-public-init.php' );
        $gestio_issues_public_init = new Gestio_Issues_Public_Init();
    }
}
Gestio_Issues_Init::get_instance();

/*function test_class( $class, $method = '__construct' ){
    $reflector = new ReflectionClass( $class );
    echo $class . ' class is beging loaded from ';
    echo '<strong>' . $reflector->getFileName() . '</strong> on line:';
    echo $reflector->getStartLine() . '</br>';
    if( method_exists( $class , $method ) ){
        echo $class .'::' . $method . ' exists';
    } else {
        echo $class .'::' . $method . ' does not exist';
    }
}
test_class( 'Gestio_Issues_Custom_Post_Type' );*/

/*add_action('activated_plugin','save_error');
function save_error(){
    file_put_contents(ABSPATH. 'wp-content/error_activation.html', ob_get_contents());
}*/