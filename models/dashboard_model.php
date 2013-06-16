<?php
/**
 * Project: Furgoweb
 * User: Hector Ordonez
 * Date: 12/06/13 15:58
 */

class dashboard_model extends Model
{
    public function __construct(){
        parent::__construct();
    }

    public function ajaxInsert($data)
    {
        $this->db->insert('data', array('data' => $data));

        return $this->db->lastInsertId();
    }

    public function getListings()
    {
        $sql = '
            SELECT id, data
            FROM data
        ';

        $result = $this->db->select($sql);
        print json_encode($result);
    }

    public function deleteData($dataId)
    {
        $conditionsArray = array(
            'id' => $dataId
        );

        $this->db->delete('data', $conditionsArray);
    }
}