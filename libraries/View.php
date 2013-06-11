<?php
/**
 * Project: Furgoweb
 * User: Hector Ordonez
 * Date: 11/06/13 12:09
 */

class View
{
    public function __construct()
    {
        $this->title = 'FurgoWeb';
    }

    public function render($name, $noInclude = FALSE)
    {
        if ($noInclude == TRUE) {
            require 'views/' . $name . '.php';
        } else {
            require 'views/header.php';
            require 'views/' . $name . '.php';
            require 'views/footer.php';
        }
    }
}