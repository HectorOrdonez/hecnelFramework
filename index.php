<?php
use engine\Bootstrap;

/**
 * Loading System Configs
 */
require 'config/database.php';
require 'config/system.php';

/**
 * Defining Autoload function
 * @todo Research more about - Modify Autoload so it loads files inside subfolders too. - http://stackoverflow.com/questions/5280347/autoload-classes-from-different-folder
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
$application->begin();