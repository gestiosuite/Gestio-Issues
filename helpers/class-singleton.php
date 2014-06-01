<?php
/**
 * Singleton abstract class
 *
 * @see http://www.guzaba.org/page/singleton-implementation-php53.html
 * @since  1.0.0
 */

abstract class Gestio_Issues_Singleton {
    private static $instance = null;
    /**
     * Class Constructor
     *
     * @since  1.0.0
     */
    private function __construct() {
    }
    /**
     * Creates or returns an instance of this class.
     *
     * @return  A single instance of this class.
     * @since  1.0.0
     */
    final public static function get_instance() {
        $class = get_called_class();
        if ( null == self::$instance[$class] ){
            $instance[$class] = new $class();
        }
        return $instance[$class];
    }
    /**
     * Thrwos an error if a clone is made
     * 
     * @return error exception
     * @since  1.0.0
     */
    final private function __clone() {
        throw new Exception('You can not clone a singleton.');
    }
}