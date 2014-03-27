<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Description:
 * @date: 13/12/13 15:30
 */

namespace engine;

/**
 * Class CronJob
 * @package engine
 */
class CronJob
{
    private static $namespaceRoute = 'engine\drivers\CronJobs\\';
    
    // This is not an instantiable class.
    private function __construct()
    {
    }

    /**
     * Calls to Input are in the format: Input::$type($fieldName);
     *
     * E.g Input::text('username') will return an object Text, which extends the class Input, with 'username' as parameter fieldName.
     *
     */
    public static function build($cronJobDriver)
    {
        $class = self::$namespaceRoute . $cronJobDriver;
        return new $class; 
    }
}