<?php
/**
 * Project: Furgoweb
 * User: Hector Ordonez
 * Date: 11/06/13 11:53
 */

class Error extends Controller
{
    /**
     * Error constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function index($msg)
    {
        $this->view->setParameter('msg', $msg);

        $this->view->render('error/index');
    }
}