<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Description:
 * Date: 11/07/13 17:32
 */

namespace application\libraries;

use application\engine\Library;
use application\models\User;
use engine\Session;

class LoginLibrary extends Library
{
    /**
     * Defining $_model Model type.
     * @var User $_model
     */
    protected $_model;

    public function __construct()
    {
        parent::__construct(new User);
    }

    /**
     * Receives a name and a password. Using the User Model, verifies if the name and password are correct.
     * If so, saves in Session the relevant data.
     * @param string $name
     * @param string $password
     * @return bool If User is now logged in or not.
     */
    public function login($name, $password)
    {
        $result = $this->_model->selectUserForLogin($name, $password);

        if ($result !== FALSE) {
            Session::set('isUserLoggedIn', true);
            Session::set('userName', $result['name']);
            Session::set('userRole', $result['role']);
            return TRUE;
        } else {
            return FALSE;
        }
    }
}