<?php
/**
 * Project: Furgoweb
 * User: Hector Ordonez
 * Date: 13/06/13 12:30
 */

namespace application\models;

use engine\Model;
use engine\Encrypter;

class UsersManagementModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getUsersList()
    {
        $sql = '
            SELECT id, name, role
            FROM user
        ';

        $result = $this->db->select($sql);

        return $result;
    }

    /**
     * Collects the data from a specific user.
     * @param int $userId User Id.
     * @return array User Data
     */
    public function getUserData($userId)
    {
        $sql = '
            SELECT
                id as userId,
                name as userName,
                password as password,
                role as userRole
            FROM user
            WHERE id = :id
        ';

        $parameters = array(
            'id'=>$userId
        );

        $result = $this->db->select($sql, $parameters);

        return $result;
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

        $this->db->insert('user', $valuesArray);
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

        $this->db->update('user', $setArray, $conditionsArray);
    }

    public function deleteUser($userId)
    {
        $conditionsArray = array(
            'id' => $userId
        );

        $this->db->delete('user', $conditionsArray);
    }
}