<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Description:
 * Date: 11/07/13 16:30
 */

namespace application\services;

use application\engine\Service;

class HelpService extends Service
{
    public function __construct()
    {
    }

    public function helpMeWith($request)
    {
        if (strlen($request) < 10) {
            $helpMessage = 'Short Help Content';
        } else {
            $helpMessage = 'Looooong and nice and complex Help Content';
        }
        return $helpMessage;
    }
}