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
            $this->bootstrapping_error('The page requested does not exist.');
        }

        // Calling Methods
        if (isset($url[1]))
        {
            if (!method_exists($url[0], $url[1]))
            {
                $this->bootstrapping_error('The method in the page requested does not exist.');
            }
            if (isset($url[2]))
            {
                $controller = new $url[0];
                $controller->{$url[1]}($url[2]);
            }
            else
            {
                $controller = new $url[0];
                $controller->{$url[1]}();
            }
        } else {
            $controller = new $url[0];
            $controller->index();
        }
    }

    private function bootstrapping_error($msg)
    {
        require 'controllers/error.php';
        $controller = new Error();
        $controller->index($msg);
        exit;
    }
}