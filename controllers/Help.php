<?php
/**
 * Project: Furgoweb
 * User: Hector Ordonez
 * Date: 11/06/13 11:20
 */

class Help extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->view->msg = 'I hope this is of help.';
        $this->view->render('help/index');
    }

    public function helpMeWith($request)
    {
        require 'models/help_model.php';
        $helpModel = new Help_Model();
        $helpMessage = $helpModel->helpMeWith($request);

        $this->view->msg = $helpMessage;
        $this->view->render('help/index');
    }
}