<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Description: Model representation of the table data.
 * Date: 12/06/13 15:58
 */

namespace application\models;

use application\engine\Model;

/**
 * Class Data
 * @package application\models
 */
class Data extends Model
{
    /**
     * Data
     * @var string $data
     */
    public $data;

    public function __construct()
    {
        $this->setModelName('data');

        parent::__construct();

        $this->addField('data');
    }
}