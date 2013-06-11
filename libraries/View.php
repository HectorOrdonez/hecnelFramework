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
        echo 'This is the View Library.<br />';
    }

    public function render($name)
    {
        require 'views/' . $name . '.php';
    }
}