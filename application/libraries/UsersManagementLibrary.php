<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Description:
 * Date: 11/07/13 19:09
 */

namespace application\libraries;

use application\engine\Library;
use application\models\UserModel;

class UsersManagementLibrary extends Library
{
    /**
     * Defining $_model Model type.
     * @var UserModel $_model
     */
    protected $_model;

    public function __construct()
    {
        parent::__construct(new UserModel);
    }

    public function getUser($userId)
    {
        return $this->_model->selectById($userId);
    }

    public function getUsersList()
    {
        return $this->_model->selectAll();
    }

    public function createUser($userName, $password, $userRole)
    {
        $this->_model->insert($userName, $password, $userRole);
    }

    public function editUser($userId, $userName, $password, $userRole)
    {
        $this->_model->update($userId, $userName, $password, $userRole);
    }

    public function deleteUser($userId)
    {
        $this->_model->delete($userId);
    }

}