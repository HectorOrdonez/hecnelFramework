<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Description:
 * Date: 11/07/13 17:32
 */

namespace application\services;

use application\engine\Service;
use application\models\User;
use engine\Session;
use engine\drivers\Exceptions\ModelException;

class LoginService extends Service
{
    public function __construct()
    {
        parent::__construct();
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
        try {
            $user = new User();
            $user->find(array('name' => $name));

            if ($user->verify($password)) {
                Session::set('isUserLoggedIn', true);
                Session::set('userName', $user->name);
                Session::set('userRole', $user->role);
                return true;
            }
        } catch (ModelException $mEx) {
            // Catching this exception just to avoid having it jumping up. Other Exceptions need to break execution, as are unexpected.
        }
        
        return false;
    }
}