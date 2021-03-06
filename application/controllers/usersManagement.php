<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Date: 13/06/13 12:25
 */

namespace application\controllers;

use application\engine\Controller;
use application\services\UsersManagementService;
use engine\Input;
use engine\Session;
use engine\Form;

class usersManagement extends Controller
{
    /**
     * Defining $_service Services type.
     * @var UsersManagementService $_service
     */
    protected $_service;

    /** Validates user access to this controller */
    public function __construct()
    {
        parent::__construct(new UsersManagementService);

        $logged = Session::get('isUserLoggedIn');
        $userRole = Session::get('userRole');
        if ($logged == FALSE OR $userRole != 'superadmin') {
            Session::destroy();
            header('location: ' . _SYSTEM_BASE_URL . 'login');
            exit;
        }
    }

    /**
     * Displays the main Users Management page
     */
    public function index()
    {
        $this->_view->setParameter('usersList', $this->_service->getUsersList());

        $this->_view->addChunk('usersManagement/index');
    }

    /**
     * Displays the User Edit page
     */
    public function openUserEdition($userId)
    {
        $userData = $this->_service->getUser($userId);

        if ($userData === FALSE) {
            $this->_view->setParameter('error', 'The user you are trying to edit does not exist.');
            $this->_view->addChunk('usersManagement/error');
        } else {
            $this->_view->setParameter('userId', $userData['id']);
            $this->_view->setParameter('userName', $userData['name']);
            $this->_view->setParameter('userRole', $userData['role']);

            $this->_view->addChunk('usersManagement/edit');
        }
    }

    /**
     * Create a User
     */
    public function createUser()
    {
        $form = new Form();
        $form->addInput(Input::build('Text', 'userName')
                ->addRule('minLength', 10)
                ->addRule('maxLength', 50)
        );

        $form->addInput(Input::build('Text', 'password')
                ->addRule('minLength', 10)
                ->addRule('maxLength', 50)
        );

        $form->addInput(Input::build('Select', 'userRole')
                ->addRule('availableOptions', array(
                    'owner',
                    'admin',
                    'basic'
                ))
        );

        $this->_service->createUser(
            $form->getInput('userName')->getValue(),
            $form->getInput('password')->getValue(),
            $form->getInput('userRole')->getValue());

        header('location: ' . _SYSTEM_BASE_URL . 'usersManagement');
        exit;
    }

    /**
     * Edits User data
     */
    public function editUser()
    {
        $form = new Form();
        $form->addInput(Input::build('Number', 'userId')
                ->addRule('min', 1)
        );

        $form->addInput(Input::build('Text', 'userName')
                ->addRule('minLength', 10)
                ->addRule('maxLength', 50)
        );

        $form->addInput(Input::build('Text', 'password')
                ->addRule('minLength', 10)
                ->addRule('maxLength', 50)
        );

        $form->addInput(Input::build('Select', 'userRole')
                ->addRule('availableOptions', array(
                    'owner',
                    'admin',
                    'basic'
                ))
        );

        $this->_service->editUser(
            $form->getInput('userId')->getValue(),
            $form->getInput('userName')->getValue(),
            $form->getInput('password')->getValue(),
            $form->getInput('userRole')->getValue()
        );

        header('location: ' . _SYSTEM_BASE_URL . 'usersManagement');
        exit;
    }

    /**
     * Deletes a User
     */
    public function deleteUser($userId)
    {
        $this->_service->deleteUser($userId);

        header('location: ' . _SYSTEM_BASE_URL . 'usersManagement');
        exit;
    }
}