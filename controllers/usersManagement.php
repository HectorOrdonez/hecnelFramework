<?php
/**
 * Project: Furgoweb
 * User: Hector Ordonez
 * Date: 13/06/13 12:25
 */

class usersManagement extends Controller
{
    /** Validates user access to this controller */
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

    /**
     * Displays the main Users Management page
     */
    public function index()
    {
        $this->view->addLibrary('js', 'usersManagement/js/default.js');

        $this->view->setParameter('usersList',$this->model->getUsersList());

        $this->view->render('usersManagement/index');
    }

    /**
     * Displays the User Edit page
     */
    public function editUser($userId)
    {
        $userData = $this->model->getUserData($userId);

        $this->view->setParameter('userId', $userData['userId']);
        $this->view->setParameter('userName', $userData['userName']);
        $this->view->setParameter('password', $userData['password']);
        $this->view->setParameter('userRole', $userData['userRole']);

        $this->view->render('usersManagement/edit');
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

        $this->model->createUser(
            $form->fetch('userName'),
            $form->fetch('password'),
            $form->fetch('userRole'));

        header('location: '. BASE_URL .'usersManagement');
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

        $this->model->saveUser($userId, $userName, $password, $userRole);

        header('location: '. BASE_URL .'usersManagement');
        exit;
    }

    /**
     * Deletes a User
     * @todo Security and verification if logged user can actually delete this user.
     */
    public function deleteUser($userId)
    {
        $userId = $userId;

        $this->model->deleteUser($userId);

        header('location: '. BASE_URL .'usersManagement');
        exit;
    }
}