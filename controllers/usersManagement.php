<?php
/**
 * Project: Furgoweb
 * User: Hector Ordonez
 * Date: 13/06/13 12:25
 */

class usersManagement extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $logged = Session::get('isUserLoggedIn');
        $userRole = Session::get('userRole');
        if ($logged == FALSE OR $userRole != 'owner')
        {
            Session::destroy();
            header('location: '. BASE_URL .'login');
            exit;
        }
    }

    public function index()
    {
        $this->view->addLibrary('js', 'usersManagement/js/default.js');

        $this->view->setParameter('usersList',$this->model->getUsersList());

        $this->view->render('usersManagement/index');
    }

    /**
     * Create
     * @todo Security and Error handling
     */
    public function createUser()
    {
        $inputData = array();
        $inputData['userName'] = $_POST['userName'];
        $inputData['password'] = md5($_POST['password']);
        $inputData['userRole'] = $_POST['userRole'];

        $this->model->createUser($inputData);
    }
}