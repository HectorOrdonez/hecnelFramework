<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Description: 
 * @date 27/03/14 19:46
 */

namespace engine\drivers;


class CronJob
{
    public function __construct()
    {
        echo 'Cronjob being constructed <br>';
    }
    
    
    public function run()
    {
        echo 'Cronjob running';
    }
    
    protected function stop()
    {
        echo 'Cronjob stopped';
    }
}