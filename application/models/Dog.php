<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Description: 
 * Sample model for developing new Model architecture.  
 * Date: 3/01/14 14:30
 */

namespace application\models;

use \ActiveRecord\Model as Model;

/**
 * Class Dog
 * @package application\models
 */
class Dog extends Model
{
    public static $table_name = 'dog'; // Table name
}