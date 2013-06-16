<?php
/**
 * Project: Furgoweb
 * User: Hector Ordonez
 * Date: 14/06/13 16:28
 */

class Encrypter
{
    /**
     * Creates an encrypted code using the Blowfish encrypting method and the given password and salt.
     * @param string $password
     * @param string $salt
     * @return string encrypted password
     */
    public static function encrypt($password, $salt)
    {
        $salt = '$2a$07$'.$salt.'$';
        return crypt($password, $salt);
    }
}