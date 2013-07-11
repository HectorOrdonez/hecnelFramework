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
//        $this->_view->setParameter('msg', 'Welcome to the Main Page for not-logged in users!.');
        $this->_view->setParameter('msg1', 'Message 1');
        $this->_view->setParameter('msg2', 'Message 2');
        $this->_view->setParameter('msg3', 'Message 3');
        $this->_view->setParameter('msg4', 'Message 4');
        $this->_view->setParameter('msg5', 'Message 5');
        $this->_view->setParameter('msg6', 'Message 6');

        $this->_view->addChunk('index/index1'); // 1
        $this->_view->addChunk('index/index2'); // 2
        $this->_view->addChunk('index/index3'); // 3
        $this->_view->addChunk('index/index4'); // 4
        $this->_view->addChunk('index/index5'); // 5
        $this->_view->addChunk('index/index6', 2); // 6 - 2

//        1
//        2
//        6
//        3
//        4
//        5

    }
}