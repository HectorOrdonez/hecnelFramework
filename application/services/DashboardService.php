<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Description:
 * Date: 11/07/13 16:47
 */

namespace application\services;

use application\engine\Service;
use application\models\Data;

class DashboardService extends Service
{
    public function __construct()
    {
        parent::__construct();
    }

    public function ajaxInsert($data)
    {
        $dataModel = new Data();
        $dataModel->data = $data;
        $dataModel->save();

        return $dataModel->toArray();
    }

    /**
     * @return array
     * @todo SELECT ALL!
     */
    public function getListings()
    {
        $dataModel = new Data();
        $dataModel->find();

        return array($dataModel->toArray());
    }

    public function deleteData($dataId)
    {
        $dataModel = new Data();
        $dataModel->find(array('id' => $dataId));
        $dataModel->delete();
    }
}