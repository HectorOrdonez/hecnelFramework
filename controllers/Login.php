<?php
/**
 * Project: Furgoweb
 * User: Hector Ordonez
 * Date: 11/06/13 11:20
 */

class Login extends Controller
{
    /**
     * Login constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Login main page
     */
    public function index()
    {
        $this->view->setParameter('msg', 'Login');

        $this->view->render('login/index');
    }

    /**
     * Logs in the User if the input parameters are right.
     */
    public function run()
    {
        $userName = $_POST['name'];
        $password = $_POST['password'];

        $this->model->login($userName, $password);
    }
}