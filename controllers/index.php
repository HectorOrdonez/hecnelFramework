<?php
/**
 * Project: Furgoweb
 * User: Hector Ordonez
 * Date: 11/06/13 11:00
 */

class Index extends Controller
{
    /**
     * Index constructor.
     * Verifies that the User is not logged in and, if so, redirects to Dashboard.
     */
    public function __construct($model)
    {
        parent::__construct($model);

        $logged = Session::get('isUserLoggedIn');
        if ($logged == TRUE)
        {
            header('location: '. _SYSTEM_BASE_URL .'dashboard');
            exit;
        }
    }

    public function index()
    {
        $this->_view->setParameter('msg', 'Welcome to the Main Page for not-logged in users!.');
        $this->_view->render('index/index');
    }
}