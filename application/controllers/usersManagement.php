<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Date: 13/06/13 12:25
 */

namespace application\controllers;

use application\engine\Controller;
use application\libraries\UsersManagementLibrary;
use engine\Session;
use engine\Form;

class usersManagement extends Controller
{
    /**
     * Defining $_library Library type.
     * @var UsersManagementLibrary $_library
     */
    protected $_library;

    /** Validates user access to this controller */
    public function __construct()
    {
        parent::__construct(new UsersManagementLibrary);

        $logged = Session::get('isUserLoggedIn');
        $userRole = Session::get('userRole');
        if ($logged == FALSE OR $userRole != 'superadmin')
        {
            Session::destroy();
            header('location: '. _SYSTEM_BASE_URL .'login');
            exit;
        }
    }

    /**
     * Displays the main Users Management page
     */
    public function index()
    {
        $this->_view->setParameter('usersList',$this->_library->getUsersList());

        $this->_view->addChunk('usersManagement/index');
    }

    /**
     * Displays the User Edit page
     */
    public function openUserEdition($userId)
    {
        $userData = $this->_library->getUser($userId);

        if ($userData === FALSE)
        {
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
        $form
            ->requireItem('userName')
            ->validate('String', array(
                'minLength' => 10,
                'maxLength' => 50
            ))
            ->requireItem('password')
            ->validate('String', array(
                'minLength' => 10,
                'maxLength' => 50
            ))
            ->requireItem('userRole')
            ->validate('Enum', array(
                'availableOptions' => array(
                    'owner',
                    'admin',
                    'basic'
                )
            ));

        $this->_library->createUser(
            $form->fetch('userName'),
            $form->fetch('password'),
            $form->fetch('userRole'));

        header('location: '. _SYSTEM_BASE_URL .'usersManagement');
        exit;
    }

    /**
     * Edits User data
     */
    public function editUser()
    {
        $form = new Form();
        $form
            ->requireItem('userId')
            ->validate('Int', array(
                'min' => 1
            ))
            ->requireItem('userName')
            ->validate('String', array(
                'minLength' => 10,
                'maxLength' => 50
            ))
            ->requireItem('password')
            ->validate('String', array(
                'minLength' => 10,
                'maxLength' => 50
            ))
            ->requireItem('userRole')
            ->validate('Enum', array(
                'availableOptions' => array(
                    'owner',
                    'admin',
                    'basic'
                )
            ));

        $this->_library->editUser(
            $form->fetch('userId'),
            $form->fetch('userName'),
            $form->fetch('password'),
            $form->fetch('userRole')
        );

        header('location: '. _SYSTEM_BASE_URL .'usersManagement');
        exit;
    }

    /**
     * Deletes a User
     */
    public function deleteUser($userId)
    {
        $this->_library->deleteUser($userId);

        header('location: '. _SYSTEM_BASE_URL .'usersManagement');
        exit;
    }
}