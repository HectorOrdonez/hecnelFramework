<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Description: 
 * Date: 13/12/13 15:38
 */

namespace engine\drivers\Inputs;

use engine\drivers\Exception;
use engine\drivers\Exceptions\InputException;
use engine\drivers\Input;

class Text extends Input
{
    /**
     * Constant that defines the minimum string length to display when the parameter contains a maxLen error and it has 
     * to be shown in an Exception.
     */
    const MIN_DISPLAYABLE_LEN = 10;

    /**
     * Text Input constructor.
     * @param $fieldName
     * @param array $requiredRules
     * @throws Exception
     */
    public function __construct($fieldName, $requiredRules = array())
    {
        // Setting field name
        $this->_fieldName = $fieldName;
        
        // Initializing valid rules for text inputs
        $this->_validRules = array(
            'minLength',
            'maxLength'
        );

        // In case the POST does not contain the value an exception is generated.
        if (!isset($_POST[$fieldName]))
        {
            throw new Exception("Required field {$fieldName} not sent in request.");
        }
        
        $this->_value = $_POST[$fieldName];

        foreach ($requiredRules as $rule)
        {
            $this->addRule($rule);
        }
    }

    /**
     * Minimum length of the text.
     * @param int $minLen Minimum length of the string
     * @throws InputException triggered if string length is lower than expected.
     */
    protected function minLength ($minLen)
    {
        if (strlen($this->getValue()) < $minLen )
        {
            throw new InputException ($this->getFieldName(), 'minLength', $this->getValue(), "Parameter '{$this->getValue()}' is too short; minimum length is {$minLen}.");
        }
    }

    /**
     * Maximum length of the text.
     * @param int $maxLen Maximum length of the string
     * @throws InputException triggered if string length is greater than expected.
     */
    protected function maxLength ($maxLen)
    {
        if (strlen($this->getValue()) > $maxLen)
        {
            $value = ($maxLen < self::MIN_DISPLAYABLE_LEN) ? $this->getValue() : substr($this->getValue(), 0, $maxLen) . '[...]';
            throw new InputException ($this->getFieldName(), 'maxLength', $value, "Parameter '{$value}' is too long; exceeds the maximum length of {$maxLen}.");
        }
    }
}