<?php
/**
 * Project: Furgoweb
 * User: Hector Ordonez
 * Date: 11/06/13 12:23
 */

namespace application\models;

use engine\Model;

class ErrorModel extends Model
{
    public function __construct()
    {
    }

    public function getError($msg)
    {
        $msg = 'Error Modelized... ' . $msg;
        return $msg;
    }
}