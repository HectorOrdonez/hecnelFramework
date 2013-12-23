<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Description: 
 * Text Input.
 * 
 * Date: 13/12/13 16:00
 */

namespace engine\drivers\Inputs;

use engine\drivers\Exceptions\InputException;
use engine\drivers\Exceptions\RuleException;
use engine\drivers\Input;

/**
 * Class Text
 * @package engine\drivers\Inputs
 */
class Text extends Input
{
    /**
     * Constant that defines the minimum string length to display when Input value exceeds maxLength rule.
     */
    const MIN_DISPLAYABLE_LEN = 10;
    
    /**
     * Default error messages.
     */
    const MSG_MAX_LENGTH_EXCEEDED = "Parameter '%s' length in field '%s' exceeds the maximum '%s'.";
    const MSG_MIN_LENGTH_NOT_REACHED = "Parameter '%s' length in field '%s' does not reach the minimum '%s'.";

    /**
     * Text Input constructor.
     * @param $fieldName
     * @throws InputException
     */
    public function __construct($fieldName)
    {
        // Setting field name
        $this->_fieldName = $fieldName;
        
        // Initializing valid rules for text inputs
        $this->_validRules = array(
            'minLength',
            'maxLength'
        );

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
            throw new RuleException ($this, 'minLength', $this->getValue(), sprintf(self::MSG_MIN_LENGTH_NOT_REACHED, $this->getValue(), $this->getFieldName(), $minLen));
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
            $this->setValue($value);
            throw new RuleException ($this, 'maxLength', $this->getValue(), sprintf(self::MSG_MAX_LENGTH_EXCEEDED, $this->getValue(), $this->getFieldName(), $maxLen));
        }
    }
}