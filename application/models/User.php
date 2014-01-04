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

class User extends Model
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
        $fields = array(
            'id',
            'name',
            'password',
            'role'
        );

        $conditions = array(
            'name' => $userName
        );

        $result = $this->db->select('user', $fields, $conditions);

        if (count($result) != 0) {
            if (Encrypter::verify($password, $result[0]['password']) === TRUE) {
                return $result[0];
            }
        }
        return FALSE;
    }

    /**
     * Collects the data from a specific user.
     * @param int $userId User Id.
     * @return array User Data
     */
    public function selectById($userId)
    {
        $fields = array(
            'id',
            'name',
            'password',
            'role'
        );

        $conditions = array(
            'id' => $userId
        );

        $result = $this->db->select('user', $fields, $conditions);

        if (count($result) > 0) {
            return $result[0];
        } else {
            return FALSE;
        }
    }

    public function selectAll()
    {
        $result = $this->db->select('user');

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
            'password' => Encrypter::encrypt($password),
            'role' => $userRole
        );

        $this->db->insert('user', $valuesArray);
    }


    public function update($userId, $userName, $password, $userRole)
    {
        $setArray = array(
            'name' => $userName,
            'password' => Encrypter::encrypt($password),
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