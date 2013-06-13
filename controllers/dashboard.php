<?php
/**
 * Project: Furgoweb
 * User: Hector Ordonez
 * Date: 12/06/13 12:28
 */

class Dashboard extends Controller
{
    /**
     * Dashboard constructor.
     * Verifies that the User has access to this class.
     */
    public function __construct()
    {
        parent::__construct();
        $logged = Session::get('isUserLoggedIn');
        if ($logged == FALSE)
        {
            Session::destroy();
            header('location: '. BASE_URL .'login');
            exit;
        }
    }

    /**
     * Dashboard Page index.
     * Builds the main Dashboard page.
     */
    public function index()
    {
        $this->view->addLibrary('js','views/dashboard/js/default.js');
        $this->view->addLibrary('css','views/dashboard/css/dashboard.css');
        $this->view->setParameter('userName', Session::get('userName'));
        $this->view->render('dashboard/index');
    }

    /**
     * Dashboard logout.
     * Allows user to log out of the system.
     */
    public function logout()
    {
        Session::destroy();
        header('location: '. BASE_URL .'login');
    }

    /**
     * Dashboard ajaxInsert.
     * Adds temporal data into a temporal table.
     */
    public function ajaxInsert()
    {
        $this->model->ajaxInsert();
    }

    /**
     * Dashboard getListings
     * Gets all temporal data.
     */
    public function getListings()
    {
        $this->model->getListings();
    }

    /**
     * Dashboard deleteData
     * Deletes a specific data.
     */
    public function deleteData()
    {
        $this->model->deleteData();
    }
}