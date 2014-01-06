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
use engine\Encrypter;

class UsersManagementService extends Service
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getUser($userId)
    {
        /**
         * @var User $user
         */
        $user = User::find(array('id' => $userId));
        return $user->attributes();
    }

    /**
     * @todo Select All!!
     * @return array
     */
    public function getUsersList()
    {
        $userList = User::find('all');

        $userArray = array();
        foreach ($userList as $user) {
            $userArray[] = array(
                'id' => $user->id,
                'name' => $user->name,
                'role' => $user->role
            );
        }

        return $userArray;
    }

    public function createUser($userName, $password, $userRole)
    {
        User::create(array(
            'name' => $userName,
            'password' => Encrypter::encrypt($password),
            'role' => $userRole
        ));
    }

    public function editUser($userId, $userName, $password, $userRole)
    {
        /**
         * @var User $user
         */
        $user = User::find(array('id' => $userId));
        
        $user->name = $userName;
        $user->password = Encrypter::encrypt($password);
        $user->role = $userRole;

        $user->save();
    }

    public function deleteUser($userId)
    {
        /**
         * @var User $user
         */
        $user = User::find(array('id' => $userId));
        $user->delete();
    }

}