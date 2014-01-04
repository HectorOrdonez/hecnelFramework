<?php
/**
 * General TODOS in the Framework.
 * @todo Hecnel 3.0 - Log system.
 * @todo Hecnel 3.0 - Multi-language support.
 * @todo Hecnel 3.0 - Create a "Extra tools" thing where I can put useful stuff like getCallingMethod functions.
 * @todo Hecnel 3.0 - Default JS libraries for the framework. 
 * @todo Hecnel 3.0 - UserSettings library - or something like that - that loads a number of User related settings, such as ...
 * @todo              Country - User's country, based on IP.
 * @todo              Language - User's language, based on browser language - if available - or country otherwise.
 * @todo              Numeric notation - Dots, commas and other numeric related formats.
 * @todo              Currency - Which currency User requires.
 * @todo Hecnel 3.0 - Validation system similar to old one, in combination with a minor Model modification to allow field type definition when constructing.
 * @todo              This would allow Models to validate data using the validation system. 
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