<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Description: 
 * Testing page.
 * Date: 12/12/13 23:00
*/

namespace application\controllers;

use application\engine\Controller;

class Test1 extends Controller
{
    /**
     * Test1 constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->_view->addChunk('tests/test1/index1', 1);
        $this->_view->addChunk('tests/test1/index2', 2);
        $this->_view->addChunk('tests/test1/index3', 1);
        $this->_view->addChunk('tests/test1/index4', 2);
        $this->_view->addChunk('tests/test1/index5', 1);
    }
}