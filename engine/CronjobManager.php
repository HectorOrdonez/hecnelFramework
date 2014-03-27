<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Description: 
 * @date 26/03/14 13:58
 */

/**
 * Loading System Configs
 */
require_once './../application/config/system.php';
require_once './../application/config/database.php';
require_once './../engine/php-activerecord/ActiveRecord.php';

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
    $cfg->set_model_directory('./../application/models');
    $cfg->set_connections(array('development' => DB_TYPE . '://' . DB_USER . ':' . DB_PASS . '@' . DB_HOST . '/' . DB_NAME));
});

use application\models\CronJob;

$cronJobs = CronJob::all(array(
        'conditions' => array('state = "idle"')
    )
);

foreach ($cronJobs as $cronJobRecord)
{
    $cronJob = \engine\CronJob::build($cronJobRecord->driver);
    $cronJob->run();
}

$file = fopen('Cronjob.txt', 'a');
fwrite($file, date('m/d/Y G:i', time()) . "- Cronjob Manager called\r\n");
fclose($file);