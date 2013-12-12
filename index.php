<?php
/**
 * General TODOS in the Framework.
 *
 * @todo Wish list - Log system.
 * @todo Wish list - Multi-language support.
 * @todo Wish list - Create a "Extra tools" thing where I can put useful stuff like getCallingMethod functions.
 * @todo Wish list - Default JS libraries for the framework.
 * @todo Design refactor - The usage of models might require refactor; a request might need none, one or more than one model.
 * @todo Design refactor - Config files should be in the application folder, as they do not belong to the framework itself.
 * @todo Database upgrade - Create a separated object that manages sql construction. Database class should only manage their execution.
 * @todo View upgrade - The view chunks should be able to use chunks inside a chunk.
 * @todo View upgrade - Need of a system that allows the adding of headers/footers easily.
 * @todo Validation upgrade - new types required: password, date and checkbox.
 * @todo Validation upgrade - Exception refactor; exceptions need a code of error, parameter that generated it and a default message in case the receptor does not manage the exception code.
 * @todo Validation upgrade - Instead of throwing general Exceptions, Validation classes needs to trigger their own Exceptions.
 * @todo Validation upgrade - In case strict mode is not enabled, Validation types like Int should parse the type of the parameter to, in that example, Int. Of course that is if the parameter passes the validation.
 * @todo Model upgrade - Consider the use of Model Interface.
 * @todo Model upgrade - Methods for the control of table fields.
 * @todo Form upgrade - Form needs to catch the exceptions triggered by the validations.
 * @todo Form upgrade - The method fetch should not retrigger an exception triggered by a validation; if a validation triggers an exception and the logic requests its fetch, it has to return false. If the logic wants the exception it can request the errors list to the Form.
 * @todo Form upgrade - Refactor in order to allow Form and Validations to work with Strict Mode extra parameter.
 * @todo Form upgrade - Consider creating a Form Exception.
 *
 */

// First thing ever, session_start.
session_start();

use engine\Bootstrap;

/**
 * Loading System Configs
 */
require 'application/config/system.php';
require 'application/config/database.php';

/**
 * Defining Autoload function
 * @param string $class Name of the class to autoload. The string contains the namespace, which will be the folders, and the name of the file.
 */
function __autoload($class)
{
    $file = _SYSTEM_ROOT_PATH . $class . '.php';
    if (is_readable($file))
    {
        require_once $file;
    }
    else
    {
        exit('Fatal error on Autoload class : ' . $class . ' - not found.');
    }

}


// Run app
$application = new Bootstrap();
$application->set_DEFAULT_CONTROLLER(_DEFAULT_CONTROLLER);
$application->set_DEFAULT_METHOD(_DEFAULT_METHOD);
$application->set_ERROR_CONTROLLER(_ERROR_CONTROLLER);
$application->set_EXCEPTION_METHOD(_EXCEPTION_METHOD);
$application->begin();