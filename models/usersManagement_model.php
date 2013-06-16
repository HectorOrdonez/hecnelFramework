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

    public function getUserData($user_id)
    {
        $statement = $this->db->prepare('
            SELECT
                id as userId,
                name as userName,
                password as password,
                role as userRole
            FROM users
            WHERE id = :id');
        $statement->execute(array(
            ':id'=>$user_id
        ));

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Creates user with the specified parameters.
     * @param string $userName
     * @param string $password Password will be encrypted.
     * @param string $userRole (owner, admin or basic)
     */
    public function createUser($userName, $password, $userRole)
    {
        $valuesArray = array(
            'name' => $userName,
            'password' => Encrypter::encrypt($password, $userName),
            'role' => $userRole
        );

        $this->db->insert('users', $valuesArray);
    }

    public function saveUser($userId, $userName, $password, $userRole)
    {
        $setArray = array(
            'name' => $userName,
            'password' => Encrypter::encrypt($password, $userName),
            'role' => $userRole
        );

        $conditionsArray = array(
            'id' => $userId
        );

        $this->db->update('users', $setArray, $conditionsArray);
    }

    public function deleteUser($userId)
    {
        $conditionsArray = array(
            'id' => $userId
        );

        $this->db->delete('users', $conditionsArray);
    }
}