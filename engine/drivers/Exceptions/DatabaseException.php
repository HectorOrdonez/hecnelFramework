<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Description:
 * Exception triggered by the Database.
 * @date: 13/12/13 17:30
 */

namespace engine\drivers\Exceptions;

use engine\drivers\Exception;

/**
 * Class DatabaseException
 * @package engine\drivers\Exceptions
 */
class DatabaseException extends Exception
{
    public function __construct($message = "", $exceptionType = self::GENERAL_EXCEPTION, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $exceptionType, $code, $previous);
    }
}