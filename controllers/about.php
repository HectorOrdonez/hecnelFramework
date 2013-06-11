<?php
/**
 * Project: Furgoweb
 * User: Hector Ordonez
 * Date: 11/06/13 11:20
 */

class About extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->view->msg = 'This is HEC Framework, construction in process.';
        $this->view->render('about/index');
    }
}