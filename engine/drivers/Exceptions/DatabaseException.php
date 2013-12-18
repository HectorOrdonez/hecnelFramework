<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Description: 
 * Date: 13/12/13 17:29
 */

namespace engine\drivers\Exceptions;

use engine\drivers\Exception;

class DatabaseException extends Exception
{
    public function __construct($message = "", $exceptionType = self::GENERAL_EXCEPTION, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $exceptionType, $code, $previous);
    }
}