<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Description:
 * Date: 12/06/13 12:30
 */

namespace engine;

class Session
{
    /**
     * Initialize Session
     */
    public static function init()
    {
        if(!isset($_SESSION)){
            session_start();
        }
    }

    /**
     * Sets SESSION parameter.
     * @param string $key
     * @param string $value
     */
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Gets SESSION parameter.
     * @param string $key
     * @return mixed
     */
    public static function get($key)
    {
        if (isset($_SESSION[$key]))
        {
            return $_SESSION[$key];
        } else {
            return false;
        }
    }

    /**
     * Destroy current user session.
     */
    public static function destroy()
    {
        session_destroy();
    }
}