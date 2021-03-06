<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Description:
 * Controller class of the application engine.
 * Date: 11/07/13 12:00
 */

namespace application\engine;

use engine\Controller as engineController;
use engine\Session;

class Controller extends engineController
{
    /**
     * Controller constructor.
     *
     * @param Service $service in which this Controller can search for the Model
     */
    public function __construct(Service $service = NULL)
    {
        parent::__construct($service);
    }

    /**
     * Method setView.
     * Requests the setView method of the engine/Controller. Then it executes the setView logic that the application needs.
     */
    protected function _setView()
    {
        parent::_setView();

        $this->_view->setTitle('Hecnel Framework');
        $this->_view->addLibrary('public/css/default.css');

        $this->_view->addLibrary('public/js/external/jquery-1.10.1.js');
        $this->_view->addLibrary('public/js/general.js');

        $this->_view->setMeta('description', array(
            'name' => 'description',
            'content' => 'This is a sample website for Hecnel Framework'
        ));

        $this->_view->setMeta('author', array(
            'name' => 'author',
            'content' => 'Hector Ordonez'
        ));

        $this->_view->setMeta('http-equiv', array(
            'http-equiv' => 'Content-Type',
            'content' => 'text/html; charset=UTF-8'
        ));

        $this->_view->setMeta('keywords', array(
            'name' => 'keywords',
            'content' => 'Hecnel Framework, PHP, JavaScript, OOP, MVC'
        ));

        $this->_view->addLibrary('application/views/general/css/base.css');
        $this->_view->addLibrary('application/views/general/js/base.js');

        $this->_view->addChunk('general/top', 'header');
        $this->_view->addChunk('general/bottom', 'footer');

        $this->_view->setParameter('userLogin', Session::get('isUserLoggedIn'));
        $this->_view->setParameter('userRole', Session::get('userRole'));
    }
}