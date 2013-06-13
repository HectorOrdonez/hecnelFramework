<?php
/**
 * Project: Furgoweb
 * User: Hector Ordonez
 * Date: 13/06/13 12:30
 */

class usersManagement_model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getUsersList()
    {
        $statement = $this->db->prepare('
            SELECT id, name, role
            FROM users');
        $statement->execute();

        return $statement->fetchAll();
    }

    public function createUser(array $inputData)
    {
        $statement = $this->db->prepare("
        INSERT INTO users (`name`, `password`, `role`)
        VALUES (:userName, :password, :role)");
        $statement->execute(array(
            ':userName' => $inputData['userName'],
            ':password' => $inputData['password'],
            ':role' => $inputData['userRole']
        ));

        header('location: '. BASE_URL .'usersManagement');
        exit;
    }
}