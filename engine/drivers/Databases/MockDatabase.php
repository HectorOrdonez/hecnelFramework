<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Description:
 * Date: 3/01/14 15:38
 */

namespace engine\drivers\Databases;

use engine\DBInterface;
use engine\DatabaseOptions;

/**
 * Class MockDatabase
 * @package engine\drivers\Databases
 */
class MockDatabase implements DBInterface
{
    private $randomNames = array(
        'John',
        'Marta',
        'Jose',
        'Antonio',
        'Lorena',
        'Gonzalo',
        'Rocio',
        'Luisa',
        'Paco',
        'Esperanza',
        'Roberto',
        'Manolo',
        'Trinidad',
        'Constantina',
        'Tim',
        'Ana',
        'Magdalena',
        'Tristana',
        'Erika',
        'Uriko',
        'Raquel',
        'Agnes'
    );

    public function __construct($dbHost, $dbName, $dbUser, $dbPass)
    {
    }

    /**
     * @param string $tableName
     * @param array $fields
     * @param array $conditions
     * @param DatabaseOptions $dbOptions
     * @return array
     */
    public function select($tableName, $fields, $conditions = array(), DatabaseOptions $dbOptions = null)
    {
        $mockResponse = array();

        $recordsAmount = rand(0, 100);

        for ($i = 0; $i < $recordsAmount; $i++) {
            $mockResponse[$i] = array();

            foreach ($fields as $field) {
                $mockResponse[$i][$field] = $this->getRandomText();
            }
        }
        
        return $mockResponse;
    }

    /**
     * @param string $tableName
     * @param array $setList
     * @param array $conditions
     * @return int Affected records
     */
    public function update($tableName, $setList, $conditions = array())
    {
        return rand(0, 100);
    }

    /**
     * @param string $tableName
     * @param array $records Associate array of records. Key is field and value is data.
     * @return int|array New records id list.
     */
    public function insert($tableName, $records)
    {
        // One entry, one new id
        if (1 == sizeof($records)) {
            return rand(0,1000);
        } else {
            // More than one entry, more than one id
            $idList = array();
            for($i=0; $i< $records; $i++ )
            {
                $idList[] = rand(0,1000);
            }
            return $idList;
        }
    }

    /**
     * @param $tableName
     * @param $conditions
     */
    public function delete($tableName, $conditions = array())
    {
    }

    /**
     * Returns the last instruction build by the Database
     * @return string Query as Database built it.
     */
    public function getLastQuery()
    {
        // TODO: Implement getLastQuery() method.
    }

    /**
     * To create mock texts
     * @return string
     */
    private function getRandomText()
    {
        return $this->randomNames[array_rand($this->randomNames)];
    }
}