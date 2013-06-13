<?php
/**
 * Project: Furgoweb
 * User: Hector Ordonez
 * Date: 12/06/13 11:17
 */

class Login_Model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function verify()
    {
        $name = $_POST['name'];
        $password = $_POST['password'];

        $statement = $this->db->prepare("
            SELECT id
            FROM users
            WHERE name = :name
            AND password = MD5(:password)");

        $statement->execute(array(
            ':name' => $name,
            ':password' => $password
        ));

        $matches = $statement->rowCount();

        if ($matches > 0)
        {
            Session::set('isUserLoggedIn', true);
            Session::set('userName', $name);
            header('location: ' . BASE_URL . 'dashboard');
        }
        else
        {
            header('location: ' . BASE_URL . 'login');
        }
    }
}