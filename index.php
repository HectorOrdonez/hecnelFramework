<?php
/**
 * General TODOS in the Framework.
 *
 * @todo Create multilanguage support.
 * @todo System to generate a dynamic header and footer with possible use of variables, session, etc.
 * @todo Add new application branch. Refactor Model, or the whole MVC. I want a framework with a branch that listens to the user, a branch that the previous branch calls for logic, another one that the logic uses to do CRUD to the Database and the View Branch that shows information to the User.
 */

use engine\Bootstrap;

/**
 * Loading System Configs
 */
require 'config/system.php';
require 'config/database.php';

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