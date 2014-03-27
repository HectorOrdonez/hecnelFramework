<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Description: 
 * @date 27/03/14 20:35
 */

namespace engine\drivers\CronJobs;

use engine\drivers\CronJob;

class Sample extends CronJob
{
    public function __construct()
    {
        echo 'Sample being constructed ';
        parent::__construct();
    }
    
    
    public function run()
    {
        echo 'Sample running';
        parent::run();
        
        $this->stop();
    }
    
    protected function stop()
    {
        echo 'Sample stopped';
        parent::stop();
    }
}