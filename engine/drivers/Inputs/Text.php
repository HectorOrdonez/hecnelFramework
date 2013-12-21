<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Description: 
 * Date: 13/12/13 15:38
 */

namespace engine\drivers\Inputs;

use engine\drivers\Exceptions\InputException;
use engine\drivers\Exceptions\RuleException;
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
     * @throws InputException
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

        foreach ($requiredRules as $rule)
        {
            $this->addRule($rule);
        }

        if (!isset($_POST[$fieldName])) {
            $this->setValue('');
            $this->setError(new RuleException($this, 'set', '', sprintf(self::MSG_EMPTY_INPUT, $fieldName)));
            return;
        }

        $this->setValue($_POST[$fieldName]);
    }

    /**
     * Minimum length of the text.
     * @param int $minLen Minimum length of the string
     * @throws RuleException triggered if string length is lower than expected.
     */
    protected function minLength ($minLen)
    {
        if (strlen($this->getValue()) < $minLen )
        {
            throw new RuleException ($this, 'minLength', $this->getValue(), "Parameter '{$this->getValue()}' is too short; minimum length is {$minLen}.");
        }
    }

    /**
     * Maximum length of the text.
     * @param int $maxLen Maximum length of the string
     * @throws RuleException triggered if string length is greater than expected.
     */
    protected function maxLength ($maxLen)
    {
        if (strlen($this->getValue()) > $maxLen)
        {
            $value = ($maxLen < self::MIN_DISPLAYABLE_LEN) ? $this->getValue() : substr($this->getValue(), 0, $maxLen) . '[...]';
            throw new RuleException ($this, 'maxLength', $value, "Parameter '{$value}' is too long; exceeds the maximum length of {$maxLen}.");
        }
    }
}