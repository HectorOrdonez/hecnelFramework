<?php

/**
 * Loading System Configs
 */
require 'config/database.php';
require 'config/system.php';

/**
 * Temporal load of drivers classes
 * @todo Modify Autoload so it loads files inside subfolders too.
 */
require 'libraries/drivers/Validator.php';
require 'libraries/drivers/Validators/String.php';
require 'libraries/drivers/Validators/Int.php';
require 'libraries/drivers/Validators/Enum.php';

/**
 * Defining Autoload function
 */
function __autoload($class)
{
    require 'libraries/'.$class.'.php';
}

// Run app
$application = new Bootstrap();
$application->set_DEFAULT_CONTROLLER(_FURGOWEB_DEFAULT_CONTROLLER);
$application->set_DEFAULT_METHOD(_FURGOWEB_DEFAULT_METHOD);
$application->set_ERROR_CONTROLLER(_FURGOWEB_ERROR_CONTROLLER);
$application->set_APPLICATION_CONTROLLERS_FOLDER(_FURGOWEB_CONTROLLERS_FOLDER);
$application->set_APPLICATION_MODELS_FOLDER(_FURGOWEB_MODELS_FOLDER);
$application->begin();