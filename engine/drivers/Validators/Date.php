<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Description: 
 * Date: 13/12/13 1:20
 */

namespace engine\drivers\validators;

use engine\drivers\Validator;
use engine\Exception;

class Date extends Validator
{
    /**
     * Name of the Validator.
     * @var string
     */
    protected static $validatorName = 'Date';

    /**
     * Expected parameter type. To check if Strict Mode is requested.
     * @var string
     */
    protected static $expectedParameterType = null;
    
    /**
     * List of accepted rules for this Validator.
     * @var array
     */
    protected static $validRules = array();

}
