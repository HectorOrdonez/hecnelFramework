<?php
/**
 * Project: Furgoweb
 * User: Hector Ordonez
 * Date: 17/06/13 13:44
 */

class Int_Validator_Driver extends Validator_Driver
{
    /**
     * Name of the Validator.
     * @var string
     */
    protected static $validatorName = 'Int';

    /**
     * Expected parameter type. To check if Strict Mode is requested.
     * @var string
     */
    protected static $expectedParameterType = 'Int';

    /**
     * List of accepted rules for this Validator.
     * @var array
     */
    protected static $validRules = array(
        'min',
        'max'
    );

    /**
     * Minimum number.
     * @param mixed $parameter Parameter being validated. Type of this parameter can be String or Int.
     * @param int $value Minimum number.
     * @throws Exception triggered if number is lower than expected.
     */
    protected static function min ($parameter, $value)
    {
        if ($parameter < $value)
        {
            throw new Exception ('Parameter [' . $parameter .'] is below the expected minimum [' . $value .'].');
        }
    }

    /**
     * Maximum number
     * @param mixed $parameter Parameter being validated. Type of this parameter can be String or Int.
     * @param int $value Maximum number
     * @throws Exception triggered if number is greater than expected.
     */
    protected static function max ($parameter, $value)
    {
        if ($parameter > $value)
        {
            throw new Exception ('Parameter [' . $parameter .'] is above the expected minimum [' . $value .'].');
        }
    }
}