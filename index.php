<?php


/**
 * Loading System Configs
 */
require 'config/database.php';
require 'config/system.php';

/**
 * Defining Autoload function
 */
function __autoload($class)
{
    require 'libraries/'.$class.'.php';
}

// Run app
$app = new Bootstrap();