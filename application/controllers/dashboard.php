<?php
/**
 * Project: Furgoweb
 * User: Hector Ordonez
 * Date: 12/06/13 12:28
 */

namespace application\controllers;

use engine\Controller;
use engine\Session as Session;
use application\models\DashboardModel as DashboardModel;


class Dashboard extends Controller
{
    /**
     * Dashboard constructor.
     * Verifies that the User has access to this class.
     */
    public function __construct()
    {
        parent::__construct(new DashboardModel);

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
        $this->_view->addLibrary('js','views/dashboard/js/default.js');
        $this->_view->addLibrary('css','views/dashboard/css/dashboard.css');

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
        header('location: '. _SYSTEM_BASE_URL .'login');
    }

    /**
     * Dashboard ajaxInsert.
     * Adds temporal data into a temporal table.
     */
    public function ajaxInsert()
    {
        $data = $_POST['data'];

        $newDataId = $this->_model->ajaxInsert($data);

        print json_encode(array('id'=>$newDataId, 'data'=>$data));
    }

    /**
     * Dashboard getListings
     * Gets all temporal data.
     */
    public function getListings()
    {
        $this->_model->getListings();
    }

    /**
     * Dashboard deleteData
     * Deletes a specific data.
     */
    public function deleteData()
    {
        $dataId = $_POST['id'];

        $this->_model->deleteData($dataId);
    }
}