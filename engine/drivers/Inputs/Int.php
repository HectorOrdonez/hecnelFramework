<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Description:
 * Input type Number is an Input that expects the text input by the User to be a number.
 * When requested the value, Input returns an Int.
 * Date: 18/12/13 22:40
 */

namespace engine\drivers\Inputs;

use engine\drivers\Exception;
use engine\drivers\Exceptions\InputException;
use engine\drivers\Exceptions\RuleException;
use engine\drivers\Input;

class Int extends Input
{
    /**
     * Default error messages.
     */
    const MSG_NO_INT = 'The input %s contains the value [%s] which is not an integer.';

    /**
     * Int Input constructor.
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
            'min',
            'max'
        );

        foreach ($requiredRules as $rule) {
            $this->addRule($rule);
        }        
        
        if (!isset($_POST[$fieldName])) {
            $this->setValue('');
            $this->setError(new RuleException($this, 'set', '', sprintf(self::MSG_EMPTY_INPUT, $fieldName)));
            return;
        }
        
        // In case the sent value is not an Int, an exception is generated. 
        $value = filter_input(INPUT_POST, $fieldName, FILTER_VALIDATE_INT);

        if (FALSE === $value) {
            $this->setValue('');
            $this->setError(new RuleException($this, 'set', '', sprintf(self::MSG_NO_INT, $fieldName, $_POST[$fieldName])));
        } else {
            $this->setValue($value);
        }
    }

    /**
     * Minimum Int amount.
     * @param int $min Minimum value allowed by the Input.
     * @throws RuleException triggered if Input value is lower than allowed.
     */
    protected function min($min)
    {
        if ($this->getValue() < $min) {
            throw new RuleException ($this, 'min', $this->getValue(), "Parameter '{$this->getValue()}' is too low; minimum value is {$min}.");
        }
    }

    /**
     * Maximum Int amount.
     * @param int $max Maximum value allowed by the Input.
     * @throws RuleException triggered if Input value is higher than allowed.
     */
    protected function max($max)
    {
        if ($this->getValue() > $max) {
            throw new RuleException ($this, 'max', $this->getValue(), "Parameter '{$this->getValue()}' is too high; maximum value is {$max}.");
        }
    }
}