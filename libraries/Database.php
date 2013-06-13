<?php
/**
 * Database Library to manage the relation with the database engine.
 * This custom Database library extends PDO.
 * For more information about PDO, this might be of interest: http://blog.tordek.com.ar/2010/11/pdo-o-por-que-todos-los-tutoriales-de-php-llevan-a-las-malas-practicas/
 *
 * Project: Furgoweb
 * User: Hector Ordonez
 * Date: 12/06/13 11:34
 */

class Database extends PDO
{
    public function __construct()
    {
        parent::__construct(
            DB_TYPE . ':host='.DB_HOST.';dbname='.DB_NAME,
            DB_USER,
            DB_PASS);


    }
}