<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Description: 
 * Date: 13/12/13 16:02
 */

namespace engine\drivers\Exceptions;

use engine\drivers\Exception;

class FormException extends Exception
{
    public function __construct($message = "", $exceptionType = self::GENERAL_EXCEPTION, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $exceptionType, $code, $previous);
    }
}