<?php
/**
 * Project: Furgoweb
 * User: Hector Ordonez
 * Date: 11/06/13 11:47
 */

class Bootstrap
{
    public function __construct()
    {
        $url = $_GET['url'];
        $url = rtrim($url, '/');

        echo 'Bootstrap, requested Url: ' . $url . '<br />';

        $url = explode('/', $url);
        print_r($url);

        $file = 'controllers/' . $url[0] . '.php';
        if (file_exists($file))
        {
            require $file;
        }
        else
        {
            require 'controllers/Error.php';
            $controller = new Error();
            return false;
        }

        $controller = new $url[0];

        if (isset($url[1]))
        {
            if (isset($url[2]))
            {
                $controller->{$url[1]}($url[2]);
            }
            else
            {
                $controller->{$url[1]}();
            }
        }
    }
}