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
        $form
            ->requireItem('name')
            ->validate('String', array(
                'minLength' => 1,
                'maxLength' => 50
            ))
            ->requireItem('password')
            ->validate('String', array(
                'minLength' => 1,
                'maxLength' => 50
            ));

        // Logic
        $login = $this->_library->login(
            $form->fetch('name'),
            $form->fetch('password'));

        // Resolution
        if ($login === TRUE) {
            header('location: ' . _SYSTEM_BASE_URL . 'dashboard');
        } else {
            header('location: ' . _SYSTEM_BASE_URL . 'login');
        }
    }
}