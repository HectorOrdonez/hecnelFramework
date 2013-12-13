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

class Test2 extends Controller
{
    /**
     * Test2 constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->_view->addChunk('tests/test2/index');
    }
}