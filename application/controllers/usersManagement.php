<?php
/**
 * Project: Furgoweb
 * User: Hector Ordonez
 * Date: 13/06/13 12:25
 */

namespace application\controllers;

use engine\Controller;
use application\models\UsersManagementModel as UsersManagementModel;
use engine\Session as Session;
use engine\Form as Form;

class usersManagement extends Controller
{
    /** Validates user access to this controller */
    public function __construct()
    {
        parent::__construct(new UsersManagementModel);

        $logged = Session::get('isUserLoggedIn');
        $userRole = Session::get('userRole');
        if ($logged == FALSE OR $userRole != 'owner')
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
        $this->_view->addLibrary('js', 'usersManagement/js/default.js');

        $this->_view->setParameter('usersList',$this->_model->getUsersList());

        $this->_view->addChunk('usersManagement/index');
    }

    /**
     * Displays the User Edit page
     */
    public function editUser($userId)
    {
        $userData = $this->_model->getUserData($userId);

        $this->_view->setParameter('userId', $userData['userId']);
        $this->_view->setParameter('userName', $userData['userName']);
        $this->_view->setParameter('password', $userData['password']);
        $this->_view->setParameter('userRole', $userData['userRole']);

        $this->_view->addChunk('usersManagement/edit');
    }

    /**
     * Create a User
     * @todo Security and Error handling
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

        $this->_model->createUser(
            $form->fetch('userName'),
            $form->fetch('password'),
            $form->fetch('userRole'));

        header('location: '. _SYSTEM_BASE_URL .'usersManagement');
        exit;
    }

    /**
     * Edits User data
     */
    public function saveUser()
    {
        $userId = $_POST['userId'];
        $userName = $_POST['userName'];
        $password = $_POST['password'];
        $userRole = $_POST['userRole'];

        $this->_model->saveUser($userId, $userName, $password, $userRole);

        exit;
        header('location: '. _SYSTEM_BASE_URL .'usersManagement');
        exit;
    }

    /**
     * Deletes a User
     * @todo Security and verification if logged user can actually delete this user.
     */
    public function deleteUser($userId)
    {
        $this->_model->deleteUser($userId);

        header('location: '. _SYSTEM_BASE_URL .'usersManagement');
        exit;
    }
}