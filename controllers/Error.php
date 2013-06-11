<?php
/**
 * Project: Furgoweb
 * User: Hector Ordonez
 * Date: 11/06/13 11:53
 */

class Error extends Controller
{
    public function __construct()
    {
        parent::__construct();
        echo 'This is an error.';
        $this->view->msg = 'This page does not exist.';
        $this->view->render('error/index');
    }
}