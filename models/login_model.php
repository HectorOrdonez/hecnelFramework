<?php
/**
 * Project: Furgoweb
 * User: Hector Ordonez
 * Date: 12/06/13 11:17
 */

class Login_Model extends Model
{
    /**
     * Login Model constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Receives a User name and its password. Verifies if these parameters are right, saving the user and its role into the Session if so.
     *
     * @param string $userName
     * @param string $password Unencrypted password
     */
    public function login($userName, $password)
    {
        $statement = $this->db->prepare("
            SELECT id, name, role
            FROM users
            WHERE name = :name
            AND password = :password");

        $statement->execute(array(
            ':name' => $userName,
            ':password' => Encrypter::encrypt($password, $userName),
        ));

        $matches = $statement->rowCount();

        if ($matches > 0)
        {
            $data = $statement->fetch();
            Session::set('isUserLoggedIn', true);
            Session::set('userName', $data['name']);
            Session::set('userRole', $data['role']);
            header('location: ' . BASE_URL . 'dashboard');
        }
        else
        {
            header('location: ' . BASE_URL . 'login');
        }
    }
}