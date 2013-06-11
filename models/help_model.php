<?php
/**
 * Project: Furgoweb
 * User: Hector Ordonez
 * Date: 11/06/13 12:23
 */

class Help_Model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function helpMeWith($request)
    {
        $helpMessage = '';
        if (strlen($request) < 10) {
            $helpMessage = 'Short Help Content';
        } else {
            $helpMessage = 'Looooong and nice and complex Help Content';
        }
        return $helpMessage;
    }
}