<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Description:
 * Date: 11/07/13 19:09
 */

namespace application\services;

use application\engine\Service;
use application\models\User;

class UsersManagementService extends Service
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getUser($userId)
    {
        $user = new User();
        $user->find(array('id'=>$userId));
        
        return $user->toArray();
    }

    /**
     * @todo Select All!!
     * @return array
     */
    public function getUsersList()
    {
        $user = new User();
        $user->find();
        
        return array($user->toArray());
    }

    public function createUser($userName, $password, $userRole)
    {
        $user = new User();
        $user->name = $userName;
        $user->setPassword($password);
        $user->role = $userRole;
        $user->save();
    }

    public function editUser($userId, $userName, $password, $userRole)
    {
        $user = new User();
        $user->find(array('id'=>$userId));
        
        $user->name = $userName;
        $user->setPassword($password);
        $user->role = $userRole;
        
        $user->save();
    }

    public function deleteUser($userId)
    {
        $user = new User();
        $user->find(array('id'=>$userId));
        $user->delete();
    }

}