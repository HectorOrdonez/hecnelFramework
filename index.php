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
 * @todo Hecnel 3.0 - Build a customized ActiveRecord system and remove the php-activerecord. This system should make use of the validation system.
 * @todo Hecnel 3.0 - Output library? A simple library that is used for Output messages from Controller. This is specially handy for handling errors nicely.
 * @todo              Example: A Controller that gets Inputs. Try-catches them to handle their validations but, in the Exception control, exits and echos are uglying around. Output::error and end. CONSIDER IT!
 * 
 * @todo FORBID CAPITAL STARTING NAMES IN CONTROLLERS!!!!!!!!!!! 
 */

// First thing ever, session_start.
session_start();

/**
 * Loading System Configs
 */
require_once 'application/config/system.php';
require_once 'application/config/database.php';
require_once 'engine/php-activerecord/ActiveRecord.php';

/**
 * Defining Autoload function
 * @param string $class Name of the class to autoload. The string contains the namespace, which will be the folders, and the name of the file.
 */
function __autoload($class)
{
    // The required class uses \ as directory separator (because of the namespace usage. This needs to be replaced with the real directory separator.
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);

    // Constructing the file path
    $file = _SYSTEM_ROOT_PATH . $class . '.php';

    if (is_readable($file)) {
        require_once $file;

    } else {
        $msg = 'Critical failure trying to Autoload the Class [' . $class . ']. The expected location is [' . $file . ' ] but was not found.';
        header("HTTP/1.1 500 " . $msg);
        exit($msg);
    }
}

/**
 * Initializing ActiveRecord
 */
ActiveRecord\Config::initialize(function($cfg)
{
    $cfg->set_model_directory('application/models');
    $cfg->set_connections(array('development' => DB_TYPE . '://' . DB_USER . ':' . DB_PASS . '@' . DB_HOST . '/' . DB_NAME));
});

use engine\Bootstrap;

// Run app
$application = new Bootstrap();
$application->set_DEFAULT_CONTROLLER(_DEFAULT_CONTROLLER);
$application->set_DEFAULT_METHOD(_DEFAULT_METHOD);
$application->set_ERROR_CONTROLLER(_ERROR_CONTROLLER);
$application->set_EXCEPTION_METHOD(_EXCEPTION_METHOD);
$application->begin();