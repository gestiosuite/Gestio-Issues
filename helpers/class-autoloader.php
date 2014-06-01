<?php
/**
 * Auto Loader
 *
 * Automatically load the classes
 *
 */
if( ! class_exists( 'Auto_Loader' ) ) {
    class Auto_Loader {
        /**
         * The type of autoloaded to use. Plugin or Theme
         * Default is 'plugin'
         * 
         * @var string
         */
        public $type;
        /**
         * To format the filename to WordPress Coding Standards
         * http://make.wordpress.org/core/handbook/coding-standards/php/
         * Default is true
         * 
         * @var  boolean
         * @see  http://make.wordpress.org/core/handbook/coding-standards/php/
         */
        public $format;
        /**
         * The directory path to your classes.
         * No leading or training slashed required.
         * Default is 'classes'
         * 
         * @var string
         */
        public $dir;
        /**
         * The prefix used for the class file names.
         * Default is 'class-' keeping with WordPress Standards
         * 
         * @var string
         */
        public $prefix;
        /**
         * Class Constructor
         *
         * @param  array $args user defined the arguments
         */
        public function __construct( $args = array() ) {
            /**
             * The deafult arguments
             * 
             * @var array $defaults the default arguments
             */
            $defaults = array(
                'type'      => 'plugin',
                'format'    => true,
                'dir'       => 'classes',
                'prefix'    => 'class-'
                );
            /**
             * Merge the default and user defined arguments
             * 
             * @var array $args the default and user defined arguments merged
             * @param array $deafults the default arguments
             * @param array $args the user defined arguments
             */
            $args = array_merge( $defaults, $args );
            /**
             * Extract the merged argument array into usable variables
             *
             * @param array $args the default and user defined arguments merged
             */
            extract( $args );
            $this->type = $type;
            $this->format = $format;
            $this->dir = $dir;
            $this->prefix = $prefix;
            spl_autoload_register( array( $this, 'autoloader') );
        }
        /**
         * Auto loads classes if the file exists
         * 
         * @param  array $class the class names
         */
        public function autoloader( $class ) {
            // If $format is true format the file name to WordPress standards format
            if( $this->format == true) {
                $class = strtolower( str_replace('_', '-', $class) );
            }
            switch ( $this->type ) {
                // If $type is set to 'theme'
                case 'theme':
                    // check if files exists in the directory
                    if ( file_exists ( get_template_directory() .'/'. $this->dir .'/'. $this->prefix . $class . '.php' ) ){
                        include( get_template_directory() .'/'. $this->dir .'/'. $this->prefix . $class . '.php');
                    }
                break;
                // if type is not set or set to 'plugin'
                case 'plugin':
                default:
                    // check if files exists in the directory
                    if ( file_exists ( plugin_dir_path( __FILE__ ) . $this->dir .'/'. $this->prefix . $class . '.php' ) ){
                        include( plugin_dir_path( __FILE__ ) . $this->dir .'/'. $this->prefix . $class . '.php');
                    }
                break;
            }
        }
    }
}