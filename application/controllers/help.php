<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Date: 11/06/13 11:20
 */

namespace application\controllers;

use application\engine\Controller;
use application\services\HelpService;

class Help extends Controller
{
    /**
     * Defining $_service Service type.
     * @var HelpService $_service
     */
    protected $_service;

    /**
     * Help constructor.
     * Adds the Help style library. As this is the construct, the library will be added for all the pages of this controller.
     */
    public function __construct()
    {
        parent::__construct(new HelpService);

        $this->_view->addLibrary('application/views/help/css/help.css');
    }

    /**
     * Builds Help main page.
     */
    public function index()
    {
        $this->_view->setParameter('msg', 'I hope this is of help.');

        $this->_view->addChunk('help/index');
    }

    /**
     * Builds Help requested page. The purpose of this is to test the delivery of parameters to methods by the Bootstrap.
     * @param string $request A random string.
     */
    public function helpMeWith($request)
    {
        $helpMessage = $this->_service->helpMeWith($request);

        $this->_view->setParameter('msg', $helpMessage);

        $this->_view->addChunk('help/index');
    }
}