<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Description: Model representation of the table data.
 * Date: 12/06/13 15:58
 */

namespace application\models;

use application\engine\Model;

class DataModel extends Model
{
    public function __construct(){
        parent::__construct();
    }

    public function insert($data)
    {
        $this->db->insert('data', array('data' => $data));

        return $this->db->lastInsertId();
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
        $sql = '
            SELECT id, data
            FROM data
        ';

        return $this->db->select($sql);
    }

}