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

    public function ajaxInsert()
    {
        $data = $_POST['data'];

        $statement = $this->db->prepare('INSERT INTO data (data) VALUES (:text)');
        $statement->execute(array('text'=>$data));

        $newDataId = $this->db->lastInsertId();

        print json_encode(array('id'=>$newDataId, 'data'=>$data));
    }

    public function getListings()
    {
        $statement = $this->db->prepare('SELECT id,data from data');
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $statement->execute();
        print json_encode($statement->fetchAll());
    }

    public function deleteData()
    {
        $id = $_POST['id'];
        $statement = $this->db->prepare('DELETE FROM data WHERE id = :id');
        $statement->execute(array('id'=>$id));
    }
}