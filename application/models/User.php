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
     * User name.
     * @var string $name
     */
    public $name;

    /**
     * User password.
     * It is protected as it is not allowed direct definition. Password has to be set through its setter, which applies Encryption.
     * @var string $password
     */
    protected $password;
    
    /**
     * User role.
     * @var string $role
     */
    public $role;

    public function __construct()
    {
        $this->setModelName('user');
        
        parent::__construct();

        $this->addField('name');
        $this->addField('password');
        $this->addField('role');
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = Encrypter::encrypt($password);
    }
    
    /**
     * Verifies that the passed password matches with User's.
     *
     * @param string $password
     * @return bool Whether this User name and password matches
     */
    public function verify($password)
    {
        return Encrypter::verify($password, $this->password);
    }
}