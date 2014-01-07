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

/**
 * Class Test1
 * @package application\controllers
 */
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
        $this->_view->addLibrary('application/views/tests/test1/css/test1.css');
        
        // Main view
        $this->_view->addChunk('tests/test1/index');

        // Initializing chunks list.
        $chunkList = array(
            'tests/test1/index1',
            'tests/test1/index2',
            'tests/test1/index3',
            'tests/test1/index4',
            'tests/test1/index5',
        );

        // Shuffling chunks list.
        shuffle($chunkList);

        foreach ($chunkList as $i => $chunkPath) {
            $this->_view->addChunk($chunkPath, 'index' . ($i + 1));
        }
    }
}