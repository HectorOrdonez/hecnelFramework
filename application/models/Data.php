<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Description: Model representation of the table data.
 * Date: 12/06/13 15:58
 */

namespace application\models;

use application\engine\Model;

class Data extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insert($data)
    {
        $id = $this->db->insert('data', array('data' => $data));

        return $id;
    }

    public function delete($dataId)
    {
        $conditionsArray = array(
            'id' => $dataId
        );

        $this->db->delete('data', $conditionsArray);
    }

    public function selectAll()
    {
        return $this->db->select('data', array('id', 'data'));
    }
}