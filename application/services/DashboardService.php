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
        $data = Data::create(array('data' => $data));

        return $data->attributes();
    }

    /**
     * @return array
     * @todo SELECT ALL!
     */
    public function getListings()
    {
        $dataList = Data::find('all');

        $dataArray = array();
        foreach ($dataList as $data) {
            $dataArray[] = array('id' => $data->id, 'data' => $data->data);
        }

        return $dataArray;
    }

    public function deleteData($dataId)
    {
        $data = Data::find(array('id' => $dataId));
        $data->delete();
    }
}