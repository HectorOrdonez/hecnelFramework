<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Date: 11/06/13 11:20
 */

namespace application\controllers;

use application\engine\Controller;
use application\libraries\LoginLibrary;
use engine\Encrypter;
use engine\Form;
use engine\Input;

class Login extends Controller
{
    /**
     * Defining $_library Library type.
     * @var LoginLibrary $_library
     */
    protected $_library;

    /**
     * Login constructor.
     */
    public function __construct()
    {
        parent::__construct(new LoginLibrary);
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
        $login = $this->_library->login(
            $form->getInput('name')->getValue(),
            $form->getInput('password')->getValue()
        );

        // Resolution
        if ($login === TRUE) {
            header('location: ' . _SYSTEM_BASE_URL . 'dashboard');
        } else {
            header('location: ' . _SYSTEM_BASE_URL . 'login');
        }
    }
}