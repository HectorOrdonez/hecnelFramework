<?php
/**
 * Project: Furgoweb
 * User: Hector Ordonez
 * Date: 11/06/13 11:00
 */

class Index extends Controller
{
    public function __construct()
    {
        parent::__construct();
        echo 'We are in the index.<br />';
    }

    public function other( $args = NULL)
    {
        echo 'This is Other<br/>';
        echo 'Optional : ' . $args;
    }
}