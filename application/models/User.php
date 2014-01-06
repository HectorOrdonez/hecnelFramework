<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Description: Model representation of the table User.
 * Date: 12/06/13 11:17
 */

namespace application\models;

use \ActiveRecord\Model as Model;

class User extends Model
{
    public static $table_name = 'user'; // Table name
}