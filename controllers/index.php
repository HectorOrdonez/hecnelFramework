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
    }

    public function index()
    {
        $this->view->msg = 'Welcome to the Main Page!.';
        $this->view->render('index/index');
    }
}