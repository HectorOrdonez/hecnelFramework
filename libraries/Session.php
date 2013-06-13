<?php
/**
 * Project: Furgoweb
 * User: Hector Ordonez
 * Date: 12/06/13 12:29
 */

class Session
{
    /**
     * Initialize Session
     */
    public static function init()
    {
        session_start();
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