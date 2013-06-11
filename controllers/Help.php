<?php
/**
 * Project: Furgoweb
 * User: Hector Ordonez
 * Date: 11/06/13 11:20
 */

class Help extends Controller{

    public function __construct()
    {
        parent::__construct();
        echo 'We are in Help';
    }

    public function moreHelp($arg = FALSE)
    {
        echo 'More Help<br />';
        echo 'Optional : ' .$arg . '<br />';

        require 'models/help_model.php';
        $model = new Help_Model();
    }
}