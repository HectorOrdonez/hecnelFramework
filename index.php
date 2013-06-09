<?php

/**
 * FURGOWEB Index file.
 */

/**
 * @todo Securing the session. Possible system - MD5 to HTTP_USER_AGENT. Research regarding how to break the session tokens might be required. Checkout :http://net.tutsplus.com/tutorials/php/creating-a-php5-framework-part-1/
 */
session_start();

// Setup definitions
define ('APP_PATH', dirname(__FILE__) . '/');

/**
 * Magic autoload function
 * USed to include the appropriate controller files when required.
 * @param string $class_name name of the class
 */
function __autoload($class_name)
{
    require_once('controllers/' . $class_name . '/' . $class_name . '.php');
}

// Require the HECRegistry.
require_once ('HECRegistry/hecregistry.class.php');
$registry = HECRegistry::singleton();

print $registry->getFrameworkName();

exit();
?>
