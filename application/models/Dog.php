<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Description: 
 * Sample model for developing new Model architecture.  
 * Date: 3/01/14 14:30
 */

namespace application\models;

use application\engine\Model;

/**
 * Class Dog
 * @package application\models
 */
class Dog extends Model
{
    /**
     * Dog name.
     * @var string $name
     */
    public $name;

    /**
     * Dog age.
     * @var int $age
     */
    public $age;

    /**
     * Dog breed.
     * @var string $breed
     */
    public $breed;

    public function __construct()
    {
        $this->setModelName('dog');
        
        parent::__construct();
        
        $this->addField('name');
        $this->addField('age');
        $this->addField('breed');
    }
}