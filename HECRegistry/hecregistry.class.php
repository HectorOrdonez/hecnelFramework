<?php

/**
 *
 * The HECRegistry Object
 * Implements the Registry and Singleton patterns to build an object that centralizes
 * references to objects.
 *
 * @version 0.1
 * @author Hector Ordonez
 */

class HECRegistry {
    /**
     * Array of objects stored in HECRegistry.
     * @access private
     */
    private static $objects = array();

    /**
     * Array of HECRegistry settings
     * @access private
     */
    private static $settings = array();

    /** Human readable name for creating Framework
     * @access private
     */
    private static $frameworkName = "Hector Framework Version 0.1";

    /**
     * Static Object where the HECRegistry is stored, allowing the Singleton logic.     *
     * @access private
     */
    private static $instance;

    /**
     * Private construct that prohibits multiple iterations of HECRegistry as it is a Singleton object.
     * @access private
     */
    private function __construct ()
    {
    }

    /**
     *  Singleton method allows logic to access the object from anywhere.
     * @access public
     * @return object
     */
    public static function singleton ()
    {
        if ( !isset(self::$instance))
        {
            $obj = __CLASS__;
            self::$instance = new $obj;
        }

        return self::$instance;
    }

    /**
     * Clone method overridden in order to prohibit it.
     * @throw Exception
     */
    public function __clone()
    {
        trigger_error('Cloning the Registry is not permitted.', E_USER_ERROR);
    }

    /**
     * Stores an object in the HECRegistry.     *
     * @param String $object the name of the object.
     * @param String $key the key for the array
     */
    public function storeObject ($object, $key)
    {
        require_once('objects/' . $object . '.class.php');
        self::$objects[$key] = new Object (self::$instance);
    }

    /**
     * Returns an object if stored in the HECRegistry.
     * @param String $key of the object as it was saved.
     * @return object
     */
    public function getObject ($key)
    {
        if ( is_object (selff::$objects[$key]))
        {
            return self::$objects[$key];
        }
    }

    /**
     * Saves given string in the settings array of HECRegistry.
     * @param string $data to store
     * @param string $key of the setting
     */
    public function storeSetting($data, $key)
    {
        self::$settings[$key] = (string) $data;
    }

    /**
     * Gets a setting from the HECRegistry if defined.
     * @param string $key of the required setting
     * @return string
     */
    public function getSetting ($key)
    {
        if ( isset(self::$settings[$key]))
        {
            return self::$settings[$key];
        }
    }

    /**
     * Retrieves the name of the Framework. Used for testing purposes.
     * @return string Framework Name
     */
    public function getFrameworkName()
    {
        return self::$frameworkName;
    }
}
?>