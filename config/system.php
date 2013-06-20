<?php
/**
 * Project: Furgoweb
 * User: Hector Ordonez
 * Date: 11/06/13 13:47
 */

// Base path of the website.
define ('_SYSTEM_BASE_URL', 'http://localhost/furgoweb/');

// Root path of the project in the server.
define ('_SYSTEM_ROOT_PATH', dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR);

/**********************************/
/** CONFIG SETTINGS FOR FURGOWEB **/
/**********************************/
define ('_FURGOWEB_DEFAULT_CONTROLLER', 'index');
define ('_FURGOWEB_DEFAULT_METHOD', 'index');
define ('_FURGOWEB_ERROR_CONTROLLER', 'error');
define ('_FURGOWEB_CONTROLLERS_FOLDER', 'controllers' . DIRECTORY_SEPARATOR);
define ('_FURGOWEB_MODELS_FOLDER', 'models' . DIRECTORY_SEPARATOR);