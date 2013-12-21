<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Date: 12/06/13 12:28
 */

namespace application\controllers;

use application\engine\Controller;
use engine\Form;
use engine\Input;
use engine\Session;
use application\libraries\DashboardLibrary;


class Dashboard extends Controller
{
    /**
     * Defining $_library Library type.
     * @var DashboardLibrary $_library
     */
    protected $_library;

    /**
     * Dashboard constructor.
     * Verifies that the User has access to this class.
     */
    public function __construct()
    {
        parent::__construct(new DashboardLibrary);
        $logged = Session::get('isUserLoggedIn');
        if ($logged == FALSE)
        {
            Session::destroy();
            header('location: '. _SYSTEM_BASE_URL .'login');
            exit;
        }
    }

    /**
     * Dashboard Page index.
     * Builds the main Dashboard page.
     */
    public function index()
    {
        $this->_view->addLibrary('js','application/views/dashboard/js/dashboard.js');
        $this->_view->addLibrary('css','application/views/dashboard/css/dashboard.css');

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

        $json_response = $this->_library->ajaxInsert($form->getInput('data')->getValue());

        print json_encode($json_response);
        $this->setAutoRender(false);
    }

    /**
     * Dashboard getListings
     * Asynchronous method.
     * Gets all temporal data.
     */
    public function getListings()
    {
        $json_response = $this->_library->getListings();

        print json_encode($json_response);
        $this->setAutoRender(false);
    }

    /**
     * Dashboard deleteData
     * Deletes a specific data.
     */
    public function deleteData()
    {
        $form = new Form();
        $form->addInput(
            Input::build('Int', 'id')
                ->addRule('min', 1)
        );

        $this->_library->deleteData($form->getInput('id')->getValue());
        $this->setAutoRender(false);
    }
}