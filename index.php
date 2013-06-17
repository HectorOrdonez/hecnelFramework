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
$app = new Bootstrap();