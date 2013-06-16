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
        $statement = $this->db->prepare('SELECT id,data from data');
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $statement->execute();
        print json_encode($statement->fetchAll());
    }

    public function deleteData($dataId)
    {
        $conditionsArray = array(
            'id' => $dataId
        );

        $this->db->delete('data', $conditionsArray);
    }
}