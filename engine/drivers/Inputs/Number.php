<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Description:
 * Number Input.
 * 
 * Date: 18/12/13 22:40
 */

namespace engine\drivers\Inputs;

use engine\drivers\Exception;
use engine\drivers\Exceptions\InputException;
use engine\drivers\Exceptions\RuleException;
use engine\drivers\Input;

/**
 * Class Number
 * @package engine\drivers\Inputs
 */
class Number extends Input
{
    /**
     * Default error messages.
     */
    const MSG_NOT_NUMERIC = "Parameter '%s' in field '%s' is not numeric.";
    const MSG_NOT_INTEGER = "Parameter '%s' in field '%s' is not integer.";
    const MSG_MAX_EXCEEDED = "Parameter '%s' in field '%s' exceeds the maximum '%s'.";
    const MSG_MIN_NOT_REACHED = "Parameter '%s' in field '%s' does not reach the minimum '%s'.";
    

    /**
     * Number Input constructor.
     * @param $fieldName
     * @throws InputException
     */
    public function __construct($fieldName)
    {
        // Setting field name
        $this->_fieldName = $fieldName;

        // Initializing valid rules for text inputs
        $this->_validRules = array(
            'min',
            'max',
            'isInt'
        );

        if (!isset($_POST[$fieldName]) or '' == $_POST[$fieldName]) {
            $this->setValue('');
            $this->setError(new RuleException($this, 'set', $this->getValue(), sprintf(self::MSG_EMPTY_INPUT, $fieldName)));
            return;
        }
        
        $this->setValue($_POST[$fieldName]);
    
        try {
            $this->parseNumber();
        } catch (RuleException $rEx)
        {
            $this->setError($rEx);
        }
    }

    /**
     * This function verifies that Input is numeric.
     * @todo Hecnel 3.0 will implement UserSettings and, if this Input still exist, it will have to consider User settings when deciding if a Number is right or not, depending on the number notation. A 5 555.55 might be right in USA, but in Spain it would be 5.555,55.
     * @todo Hecnel 3.0 Stronger validation might be required regarding dots, commas, etc. 
     */
    private function parseNumber ()
    {
        $rawValue = $this->getValue();
        
        // Separate Checking commas.
        $commas = substr_count($rawValue, ',');

        switch ($commas)
        {
            case 0:
                $this->checkNatural($rawValue);
                break;
            case 1:
                list($naturalPart, $decimalPart) = preg_split('/,/', $rawValue);
                $this->checkNatural($naturalPart);
                $this->checkDigits($decimalPart);
                break;
            default:
                throw new RuleException($this, 'set', $this->getValue(), sprintf(self::MSG_NOT_NUMERIC, $this->getValue(), $this->getFieldName()));
        }
        
        // Number verified. Cleaning it.
        $noDots = str_replace('.', '', $rawValue);
        $parsedValue = str_replace(',', '.', $noDots);
        $this->setValue($parsedValue);
    }

    /**
     * Function that validates a natural number.
     * @param $natural
     * @throws RuleException
     */
    private function checkNatural ($natural)
    {
        // Removing, if any, the negative symbol that a negative natural number can have.
        if ('-' === $natural[0])
        {
            $natural = substr($natural, 1);
        }
        
        $splitByDot = preg_split('/\./', $natural);
        
        if (1 < sizeof($splitByDot))
        {
            // First part can contain between 1 and 3 numbers.
            $this->checkDigits($splitByDot[0]);
            if (strlen($splitByDot[0]) < 1 OR strlen($splitByDot[0]) > 3)
            {
                throw new RuleException ($this, 'set', $this->getValue(), sprintf(self::MSG_NOT_NUMERIC, $this->getValue(), $this->getFieldName()));
            }
            
            // Other parts must have 3 numbers.
            for ($i = 1; $i < sizeof($splitByDot); $i++)
            {
                $this->checkDigits($splitByDot[$i]);
                if (strlen($splitByDot[$i]) != 3)
                {
                    throw new RuleException ($this, 'set', $this->getValue(), sprintf(self::MSG_NOT_NUMERIC, $this->getValue(), $this->getFieldName()));
                }
            }
        } else {
            $this->checkDigits($natural);
        }
    }

    /**
     * Function that verifies that all characters in a string are numbers [0-9].
     * @param $digits
     * @throws RuleException
     */
    private function checkDigits ($digits)
    {
        if (!ctype_digit($digits))
        {
            throw new RuleException($this, 'set', $this->getValue(), sprintf(self::MSG_NOT_NUMERIC, $this->getValue(), $this->getFieldName()));
        }
    }

    /**
     * Minimum amount.
     * @param int $min Minimum value allowed by the Input.
     * @throws RuleException triggered if Input value is lower than allowed.
     */
    protected function min($min)
    {
        if ($this->getValue() < $min) {
            throw new RuleException ($this, 'min', $this->getValue(), sprintf(self::MSG_MIN_NOT_REACHED, $this->getValue(), $this->getFieldName(), $min));
        }
    }

    /**
     * Maximum amount.  
     * @param int $max Maximum value allowed by the Input.
     * @throws RuleException triggered if Input value is higher than allowed.
     */
    protected function max($max)
    {
        if ($this->getValue() > $max) {
            throw new RuleException ($this, 'max', $this->getValue(),sprintf(self::MSG_MAX_EXCEEDED, $this->getValue(), $this->getFieldName(), $max));
        }
    }
    
    /**
     * Verifies that this number is Integer.
     * @throws RuleException triggered if Input is not an Integer.
     */
    protected function isInt()
    {
        if ((string)(int)$this->getValue() !== $this->getValue()) {
            throw new RuleException ($this, 'isInteger', $this->getValue(), sprintf(self::MSG_NOT_INTEGER, $this->getValue(), $this->getFieldName()));
        }
    }
}