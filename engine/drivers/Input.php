<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Description:
 * Input Object is a helper for getting data from Post requests.
 * Date: 13/12/13 16:00
 */

namespace engine\drivers;

use engine\drivers\Exceptions\InputException as InputException;
use engine\drivers\Exceptions\RuleException;

abstract class Input
{
    /**
     * Field name related to this input.
     * @var string
     */
    protected $_fieldName = '';

    /**
     * Accepted rules for this input.
     * @var array
     */
    protected $_validRules = array();

    /**
     * Requested rules to verify when validating this input.
     * @var array
     */
    protected $_requestedRules = array();

    /**
     * The input value.
     * @var null
     */
    protected $_value = null;

    /**
     * List of exceptions, if any, of this Input.
     * @var RuleException[]
     */
    protected $_errors;

    /**
     * Input constructors will always require a field name string and, optionally, a required rules array. 
     * @param string $fieldName
     * @param array $requiredRules
     */
    abstract public function __construct($fieldName, $requiredRules = NULL);
    
    /**
     * Validates this input by following the set rules. Some default rules might exist depending on the Input.
     * E.g Text Inputs will always verify that its value is a string. That does not mean that Text Input can not
     * verify, too, that the value is an Int representation, for example.
     * 
     * Returns whether the Input passes the validation or not.
     * 
     * @return boolean
     */
    public function validate()
    {
        foreach ($this->_requestedRules as $ruleName => $ruleValue)
        {
            $this->{$ruleName}($ruleValue);
        }
    }

    /**
     * Return either InputExceptions or false, if none.
     * @return bool|RuleException[]
     */
    public function getValidationErrors()
    {
        foreach ($this->_requestedRules as $ruleName => $ruleValue)
        {
            try {
                $this->{$ruleName}($ruleValue);
            } catch (RuleException $iEx)
            {
                $this->_errors[] = $iEx;
            }
        }

        return (sizeof($this->_errors) != 0)? $this->_errors : false;
    }

    /**
     * Gets this input fieldName.
     * @return string
     */
    public function getFieldName()
    {
        return $this->_fieldName;
    }

    /**
     * Adds a rule to the rules list to verify when validating this input.
     * The rule has to be included in the rules list accepted for this specific input type.
     *
     * Notice that this method does not throw an InputException. That is because if an Input is requested a rule not
     * related to it, the problem is beyond the Input - something out there thinks this input is something it ain't!
     * 
     * @param string $rule Rule.
     * @param null $value Optional value that some rules needs to work.
     * @return Input $this
     * @throws InputException
     */
    public function addRule($rule, $value = null)
    {
        if (!in_array($rule, $this->_validRules))
        {
            throw new InputException("Requested rule {$rule} is not valid for a " . get_class($this) ." input.");
        }
        $this->_requestedRules[$rule] = $value;
        
        return $this;
    }

    /**
     * Delivers this input value.
     * @return null
     * @throws Exceptions\InputException
     */
    public function getValue()
    {
        if (sizeof($this->_errors) > 0)
        {
            throw new InputException('Can not provide the value of the Input ' . $this->getFieldName() . ' because it did not pass validation.'); 
        }
        return $this->_value;
    }
}