<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 *
 * Class InputException
 * @package engine\drivers\Exceptions
 *
 * Description:
 * Exception triggered by an Input because of a non-passed validation.
 *
 * Date: 13/12/13 16:02
 */

namespace engine\drivers\Exceptions;

use engine\drivers\Exception;

class InputException extends Exception
{
    /**
     * Input name that did not pass validation.
     * @var
     */
    protected $_fieldName;
    /**
     * Rule that did not pass validation.
     * @var
     */
    protected $_rule;

    /**
     * Input Value that could not pass the validation.
     * @var
     */
    protected $_value;

    /**
     * InputException constructor.
     * @param string $fieldName Input name that throws exception
     * @param string $rule The violated rule.
     * @param null $value The incorrect value.
     * @param string $message Default message that explains the exception.
     * @param Exception|int $exceptionType Exception level.
     * @param int $code Exception code.
     * @param Exception $previous
     */
    public function __construct($fieldName, $rule, $value, $message = "", $exceptionType = self::GENERAL_EXCEPTION, $code = 0, Exception $previous = null)
    {
        $this->_fieldName = $rule;
        $this->_rule = $rule;
        $this->_value = $value;

        parent::__construct($message, $exceptionType, $code, $previous);
    }

    /**
     * Returns the violated rule name.
     * @return string
     */
    public function getViolatedRule()
    {
        return $this->_rule;
    }

    /**
     * Returns the Input name.
     * @return string
     */
    public function getInputName()
    {
        return $this->_fieldName;
    }

    /**
     * Returns the value that broke the rule.
     * @return null
     */
    public function getIncorrectValue()
    {
        return $this->_value;
    }
}