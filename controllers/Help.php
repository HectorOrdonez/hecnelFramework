<?php
/**
 * Project: Furgoweb
 * User: Hector Ordonez
 * Date: 11/06/13 11:20
 */

class Help extends Controller
{
    /**
     * Help constructor.
     * Adds the Help style library. As this is the construct, the library will be added for all the pages of this controller.
     */
    public function __construct()
    {
        parent::__construct();
        $this->view->addLibrary('css','views/help/css/help.css');
    }

    /**
     * Builds Help main page.
     */
    public function index()
    {
        $this->view->setParameter('msg', 'I hope this is of help.');

        $this->view->render('help/index');
    }

    /**
     * Builds Help requested page. The purpose of this is to test the delivery of parameters to methods by the Bootstrap.
     * @param string $request A random string.
     */
    public function helpMeWith($request)
    {
        $helpMessage = $this->model->helpMeWith($request);

        $this->view->setParameter('msg', $helpMessage);

        $this->view->render('help/index');
    }
}