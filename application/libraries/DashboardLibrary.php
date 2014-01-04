<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Description:
 * Date: 11/07/13 16:47
 */

namespace application\libraries;

use application\engine\Library;
use application\models\Data;

class DashboardLibrary extends Library
{
    /**
     * Defining $_model Model type.
     * @var Data $_model
     */
    protected $_model;

    public function __construct()
    {
        parent::__construct(new Data);
    }

    public function ajaxInsert($data)
    {
        $newDataId = $this->_model->insert($data);
        return array('id' => $newDataId, 'data' => $data);
    }

    public function getListings()
    {
        $allData = $this->_model->selectAll();
        return $allData;
    }

    public function deleteData($dataId)
    {
        $this->_model->delete($dataId);
    }
}