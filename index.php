<?php
/**
 * General TODOS in the Framework.
 *
 * @todo Wish list - Log system.
 * @todo Wish list - Multi-language support.
 * @todo Wish list - Create a "Extra tools" thing where I can put useful stuff like getCallingMethod functions.
 * @todo Wish list - Default JS libraries for the framework.
 * @todo Design refactor - The usage of models might require refactor; a request might need none, one or more than one model.
 * @todo Database upgrade - Create a separated object that manages sql construction. Database class should only manage their execution.
 * @todo View upgrade - The view chunks should be able to use chunks inside a chunk.
 * @todo View upgrade - Need of a system that allows the adding of headers/footers easily.
 * @todo Validation upgrade - new types required: password, date and checkbox.
 * @todo Model upgrade - Consider the use of Model Interface.
 * @todo Model upgrade - Methods for the control of table fields.
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