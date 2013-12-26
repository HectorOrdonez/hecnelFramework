<?php
/**
 * General TODOS in the Framework.
 *
 * @todo Hecnel 2.0 - Design refactor - The usage of models might require refactor; a request might need none, one or more than one model.
 * @todo Hecnel 2.0 - Database upgrade - Create a separated object that manages sql construction. Database class should only manage their execution.
 * @todo Hecnel 2.0 - Model upgrade - Consider the use of Model Interface. 
 * @todo Hecnel 2.0 - Model upgrade - Methods for the control of table fields.
 *
 * @todo Hecnel 3.0 - Log system.
 * @todo Hecnel 3.0 - Multi-language support.
 * @todo Hecnel 3.0 - Create a "Extra tools" thing where I can put useful stuff like getCallingMethod functions.
 * @todo Hecnel 3.0 - Default JS libraries for the framework. 
 * @todo Hecnel 3.0 - UserSettings library - or something like that - that loads a number of User related settings, such as ...
 * @todo              Country - User's country, based on IP.
 * @todo              Language - User's language, based on browser language - if available - or country otherwise.
 * @todo              Numeric notation - Dots, commas and other numeric related formats.
 * @todo              Currency - Which currency User requires.
 * @todo Hecnel 3.0 - View upgrade - Use a better approach to print parameters in View.
 * @todo              This is because the current approach $this->parameter will give issues eventually. 
 * @todo              View Parameters should be accessed with a getter!! 
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