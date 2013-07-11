<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Description: Model representation of the table User.
 * Date: 12/06/13 11:17
 */

namespace application\models;

use application\engine\Model;
use engine\Encrypter;

class UserModel extends Model
{
    /**
     * User Model constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Receives a User name and its password. Verifies if these parameters are right and, if so, returns its data.
     *
     * @param string $userName
     * @param string $password Unencrypted password.
     * @return mixed array/bool User data if found, false if not.
     */
    public function selectUserForLogin($userName, $password)
    {
        $sql = '
            SELECT id, name, role
            FROM user
            WHERE name = :name
            AND password = :password
        ';

        $parameters = array(
            'name' => $userName,
            'password' => Encrypter::encrypt($password, $userName)
        );

        $result = $this->db->select($sql, $parameters);

        if (count($result) > 0) {
            return $result[0];
        } else {
            return FALSE;
        }
    }

    /**
     * Collects the data from a specific user.
     * @param int $userId User Id.
     * @return array User Data
     */
    public function selectById($userId)
    {
        $sql = '
            SELECT
                id AS userId,
                name AS userName,
                password AS password,
                role AS userRole
            FROM user
            WHERE id = :id
        ';

        $parameters = array(
            'id' => $userId
        );

        $result = $this->db->select($sql, $parameters);

        if (count($result) > 0)
        {
            return $result[0];
        } else {
            return FALSE;
        }
    }

    public function selectAll()
    {
        $sql = '
            SELECT id, name, role
            FROM user
        ';

        $result = $this->db->select($sql);

        return $result;
    }

    /**
     * Creates user with the specified parameters.
     * @param string $userName
     * @param string $password Password will be encrypted.
     * @param string $userRole (owner, admin or basic)
     */
    public function insert($userName, $password, $userRole)
    {
        $valuesArray = array(
            'name' => $userName,
            'password' => Encrypter::encrypt($password, $userName),
            'role' => $userRole
        );

        $this->db->insert('user', $valuesArray);
    }


    public function update($userId, $userName, $password, $userRole)
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


    public function delete($userId)
    {
        $conditionsArray = array(
            'id' => $userId
        );

        $this->db->delete('user', $conditionsArray);
    }
}