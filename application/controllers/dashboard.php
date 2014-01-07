<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Date: 12/06/13 12:28
 */

namespace application\controllers;

use application\engine\Controller;
use application\services\DashboardService;
use engine\Form;
use engine\Input;
use engine\Session;

/**
 * Class Dashboard
 * @package application\controllers
 */
class Dashboard extends Controller
{
    /**
     * Defining $_service Service type.
     * @var DashboardService $_service
     */
    protected $_service;

    /**
     * Dashboard constructor.
     * Verifies that the User has access to this class.
     */
    public function __construct()
    {
        parent::__construct(new DashboardService);
        $logged = Session::get('isUserLoggedIn');
        if (FALSE === $logged) {
            Session::destroy();
            header('location: ' . _SYSTEM_BASE_URL . 'login');
            exit;
        }
    }

    /**
     * Dashboard Page index.
     * Builds the main Dashboard page.
     */
    public function index()
    {
        $this->_view->addLibrary('application/views/dashboard/js/dashboard.js');
        $this->_view->addLibrary('application/views/dashboard/css/dashboard.css');

        $this->_view->setParameter('userName', Session::get('userName'));

        $this->_view->addChunk('dashboard/index');
    }

    /**
     * Dashboard logout.
     * Allows user to log out of the system.
     */
    public function logout()
    {
        Session::destroy();
        header('location: ' . _SYSTEM_BASE_URL . 'login');
        exit;
    }

    /**
     * Dashboard ajaxInsert.
     * Asynchronous method.
     * Adds temporal data into a temporal table.
     */
    public function ajaxInsert()
    {
        $form = new Form();
        $form->addInput(
            Input::build('Text', 'data')
                ->addRule('minLength', 1)
                ->addRule('minLength', 50)
        );

        $json_response = $this->_service->ajaxInsert($form->getInput('data')->getValue());

        print json_encode($json_response);
    }

    /**
     * Dashboard getListings
     * Asynchronous method.
     * Gets all temporal data.
     */
    public function getListings()
    {
        $json_response = $this->_service->getListings();

        print json_encode($json_response);
    }

    /**
     * Dashboard deleteData
     * Deletes a specific data.
     */
    public function deleteData()
    {
        $form = new Form();
        $form->addInput(
            Input::build('Number', 'id')
                ->addRule('min', 1)
        );

        $this->_service->deleteData($form->getInput('id')->getValue());
    }
}