<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Description:
 * Database factory
 * @date: 3/01/14 15:00
 */

namespace engine;

use engine\drivers\Databases\MockDatabase;
use engine\drivers\Databases\MySqlDatabase;
use engine\drivers\Exception;

/**
 * Interface DBInterface
 * @package engine
 */
interface DBInterface
{
    const WRONG_FORMAT_INSERT = 'Requested action Insert received wrong parameters.';
    
    /**
     * DB Select requests the database the list of records that fulfills the given conditions and options, if any.
     * @param string $tableName
     * @param array $fields
     * @param array $conditions
     * @param DatabaseOptions $dbOptions
     * @return array
     */
    public function select($tableName, $fields, $conditions = array(), DatabaseOptions $dbOptions = null);

    /**
     * @param string $tableName
     * @param array $setList
     * @param array $conditions
     * @return int Affected records
     */
    public function update($tableName, $setList, $conditions = array());

    /**
     * @param string $tableName
     * @param array $records Associate array of records. Key is field and value is data.
     * @return int|array New records id list.
     */
    public function insert($tableName, $records);

    /**
     * @param $tableName
     * @param $conditions
     */
    public function delete($tableName, $conditions = array());

    /**
     * Returns the last instruction build by the Database
     * @return string Query as Database built it.
     */
    public function getLastQuery();
}

/**
 * Class Database
 * @package engine
 */
class Database
{
    // This is not an instantiable class.
    private function __construct()
    {
    }

    /**
     * Instantiates and returns a Database object.
     * @param string $dbType Database name
     * @param string $dbHost Database host
     * @param string $dbName Database name
     * @param string $dbUser Database user
     * @param string $dbPass Database pass
     * @return DBInterface
     * @throws drivers\Exception
     */
    public static function getInstance($dbType, $dbHost, $dbName, $dbUser, $dbPass)
    {
        if (is_null($dbHost) or is_null($dbName) or is_null($dbUser) or is_null($dbPass)) {
            throw new Exception ('Database factory parameters are incomplete.');
        }

        switch ($dbType) {
            case 'mysql':
                $db = new MySqlDatabase($dbHost, $dbName, $dbUser, $dbPass);
                break;
            case 'mock':
                $db = new MockDatabase($dbHost, $dbName, $dbUser, $dbPass);
                break;
            default:
                throw new Exception ('Requested Database type "' . $dbType . '" does not exist.');
        }

        return $db;
    }
}