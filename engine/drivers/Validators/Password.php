<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Description: 
 * Password Validation is, basically, the same than String Validator. The only difference, so far, is that Password 
 * Validator does not display the inputted password when reporting exceptions.
 * Date: 13/12/13 1:20
 */

namespace engine\drivers\validators;

use engine\drivers\Validators\String;
use engine\Exception;

class Password extends String
{
    /**
     * Minimum length of this password.
     * @param string $parameter Parameter being validated.
     * @param int $value Minimum length of the string
     * @throws Exception triggered if password length is lower than expected.
     */
    protected static function minLength ($parameter, $value)
    {
        if (strlen($parameter) < $value)
        {
            throw new Exception ('Password is too short; minimum length is ' . $value .'.');
        }
    }

    /**
     * Maximum length of this password.
     * @param string $parameter Parameter being validated.
     * @param int $value Maximum length of the password
     * @throws Exception triggered if password length is higher than expected.
     */
    protected static function maxLength ($parameter, $value)
    {
        if (strlen($parameter) > $value)
        {
            throw new Exception ('Password is too long; exceeds the maximum length of ' . $value .'.');
        }
    }
}
