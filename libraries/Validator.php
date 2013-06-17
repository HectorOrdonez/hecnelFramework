<?php
/**
 * Project: Furgoweb
 * User: Hector Ordonez
 * Date: 16/06/13 22:08
 */

class Validator
{
    private static $allowedTypes = array(
        'String',
        'Int',
        'Enum'
    );

    // This is not an instantiable class.
    private function __construct() {}

    private static function validateType($type)
    {
        if(!in_array($type, self::$allowedTypes))
        {
            throw new Exception ('Requested Validator type "' . $type . '" does not exist.');
        }
    }

    /**
     * Calls to Validator are in the format: Validator::$type($parameter, $rulesArray, $strictMode);
     *
     * @param string $type Name of Validator Type
     * @param array $args List of arguments;
     *      0 => $parameter
     *      1 => $rules
     *      2 => $strictMode
     */
    public static function __callStatic($type, $args)
    {
        self::validateType($type);

        $parameter = $args[0];
        $rules = (isset($args[1])) ? $args[1] : NULL;
        $strictMode = (isset($args[2])) ? $args[2] : NULL;

        $validator = ucfirst($type) . '_Validator_Driver';
        $validator::validate($parameter, $rules, $strictMode);
    }
}