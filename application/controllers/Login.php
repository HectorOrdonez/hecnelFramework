<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Date: 11/06/13 11:20
 */

namespace application\controllers;

use application\engine\Controller;
use application\services\LoginService;
use engine\Encrypter;
use engine\Form;
use engine\Input;

class login extends Controller
{
    /**
     * Defining $_service Service type.
     * @var LoginService $_service
     */
    protected $_service;

    /**
     * Login constructor.
     */
    public function __construct()
    {
        parent::__construct(new LoginService);
    }

    /**
     * Login main page
     */
    public function index()
    {
        $this->_view->setParameter('msg', 'Login');

        $this->_view->addChunk('login/index');
    }

    /**
     * Logs in the User if the input parameters are right.
     */
    public function run()
    {
        // Validation
        $form = new Form();
        $form->addInput(
            Input::build('Text', 'name')
                ->addRule('minLength', 1)
                ->addRule('maxLength', 50)
        );
        $form->addInput(
            Input::build('Text', 'password')
                ->addRule('minLength', 1)
                ->addRule('maxLength', 50)
        );

        // Logic
        $login = $this->_service->login(
            $form->getInput('name')->getValue(),
            $form->getInput('password')->getValue()
        );

        // Resolution
        if (true === $login) {
            header('location: ' . _SYSTEM_BASE_URL . 'dashboard');
            exit;
        } else {
            header('location: ' . _SYSTEM_BASE_URL . 'login');
            exit;
        }
    }
}