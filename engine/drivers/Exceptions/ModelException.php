<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Description:
 * Exception triggered by Models.`
 * @date 04/01/2014
 */
namespace engine\drivers\Exceptions;

use engine\drivers\Exception;

/**
 * Class ModelException
 * @package engine\drivers\Exceptions
 */
class ModelException extends Exception
{
    public function __construct($message = "", $exceptionType = self::GENERAL_EXCEPTION, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $exceptionType, $code, $previous);
    }
}