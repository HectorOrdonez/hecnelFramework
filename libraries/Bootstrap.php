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
        if (isset($_GET['url']))
        {
            $url = $_GET['url'];
        } else
        {
            $url = NULL;
        }
        $url = rtrim($url, '/');

        $url = explode('/', $url);
        if (empty($url[0]))
        {
            require 'controllers/index.php';
            $controller = new Index();
            $controller->index();
            return false;
        }
        $file = 'controllers/' . $url[0] . '.php';
        if (file_exists($file))
        {
            require $file;
        }
        else
        {
            require 'controllers/error.php';
            $controller = new Error();
            $controller->index();
            return false;
        }

        $controller = new $url[0];

        // Calling Methods
        if (isset($url[1]))
        {
            if (!method_exists($controller, $url[1]))
            {
                require 'controllers/error.php';
                $controller = new Error();
                $controller->index();
                return false;
            }
            if (isset($url[2]))
            {
                $controller->{$url[1]}($url[2]);
            }
            else
            {
                $controller->{$url[1]}();
            }
        } else {
            $controller->index();
        }
    }
}