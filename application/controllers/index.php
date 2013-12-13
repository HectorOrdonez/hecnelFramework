<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Date: 11/06/13 11:00
 */

namespace application\controllers;

use application\engine\Controller;
use engine\Session;

class Index extends Controller
{
    /**
     * Index constructor.
     * Verifies that the User is not logged in and, if so, redirects to Dashboard.
     */
    public function __construct()
    {
        parent::__construct();
        $logged = Session::get('isUserLoggedIn');
        if ($logged == TRUE)
        {
            header('location: '. _SYSTEM_BASE_URL .'dashboard');
            exit;
        }
    }

    public function index()
    {
        $this->_view->addChunk('index/index');
    }
}