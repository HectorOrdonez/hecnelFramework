<?php
/**
 * Database Library to manage the relation with the database engine.
 * This custom Database library extends PDO.
 * For more information about PDO, this might be of interest: http://blog.tordek.com.ar/2010/11/pdo-o-por-que-todos-los-tutoriales-de-php-llevan-a-las-malas-practicas/
 *
 *
 * @todo Find a way to build a Database debugger. Link with a possible solution/hint - http://stackoverflow.com/questions/210564/getting-raw-sql-query-string-from-pdo-prepared-statements/210693#210693
 * @todo Build Database Exception manager.
 * @todo Find and implement a nice way to manage CRUD and complex queries (with group by's, joins, etc). Current system supports only basic usage.
 *
 * Project: Furgoweb
 * User: Hector Ordonez
 * Date: 12/06/13 11:34
 */

namespace engine;

class Database extends \PDO
{
    /**
     * dbType, dbHost and dbName will turn into the data source name parameter required by the PDO class.
     * @param string $dbType MySql
     * @param string $dbHost localhost
     * @param string $dbName FurgoWeb
     * @param string $dbUser User
     * @param string $dbPass Password
     */
    public function __construct($dbType, $dbHost, $dbName, $dbUser, $dbPass)
    {
        parent::__construct(
            "{$dbType}:host={$dbHost};dbname={$dbName}",
            $dbUser,
            $dbPass);
    }

    /**
     * Selects data from Database table.
     * @param string $sql SQL Query.
     * @param array $parameters Optional parameters to bind into the SQL Query.
     * @param int $fetchMode Optional parameter if a specific Fetch method is required.
     * @return array Fetched Da ta from query.
     */
    public function select($sql, $parameters=array(), $fetchMode = \PDO::FETCH_ASSOC)
    {
        $statement = $this->prepare($sql);

        foreach ($parameters as $field=>$value)
        {
            $statement->bindValue(":{$field}", $value);
        }

        // Action!
        $statement->execute();

        // Returning results
        return $statement->fetchAll($fetchMode);
    }

    /**
     * Inserts data into a Database table.
     * @param string $table Name of the Table to insert into.
     * @param string $data Associative array of data.
     */
    public function insert($table, $data)
    {
        // Creating string of field names
        $fieldNames = implode('`,`', array_keys($data));
        // Creating string of values
        $fieldValues = ':' . implode(', :', array_keys($data));

        // Preparing Statement
        $statement = $this->prepare("INSERT INTO {$table} (`{$fieldNames}`) VALUES ({$fieldValues})");

        // Binding values
        foreach ($data as $key=>$value)
        {
            $statement->bindValue(":{$key}", $value);
        }

        // Action!
        $statement->execute();
    }

    /**
     * Updates data of a Database table for the specified conditions
     * @param string $table Name of the table to update.
     * @param array $set Data array of data to update in the form of renewedField=>newValue
     * @param array $conditions Conditions array in the form of conditionedField=>conditionalValue
     */
    public function update($table, $set, $conditions)
    {
        ksort($set);
        ksort($conditions);

        $setString = '';
        $conditionsString = '';

        // Creating string of fields to set
        foreach (array_keys($set) as $renewedField)
        {
            $setString .= "`$renewedField` = :$renewedField,";
        }
        $setString = substr($setString, 0, -1);

        // Creating string of conditional fields
        foreach (array_keys($conditions) as $conditionedField)
        {
            $conditionsString .= "`$conditionedField` = :$conditionedField AND";
        }
        $conditionsString = substr($conditionsString , 0, -4);

        // Preparing Statement
        $statement = $this->prepare("UPDATE {$table} SET {$setString} WHERE $conditionsString");

        // Binding new values
            foreach ($set as $renewedField=>$newValue)
        {
            $statement->bindValue(":{$renewedField}", $newValue);
        }

        // Binding conditionals
        foreach ($conditions as $conditionedField => $conditionalValue)
        {
            $statement->bindValue(":{$conditionedField}", $conditionalValue);
        }

        // Action!
        $statement->execute();
    }

    /**
     * Deletes data from a Database table.
     * @param string $table Name of the Table into which data will be deleted
     * @param string $conditions Conditions array in the form of conditionedField=>conditionalValue
     */
    public function delete($table, $conditions)
    {
        $conditionsString = '';

        // Creating string of conditional fields
        foreach (array_keys($conditions) as $conditionedField)
        {
            $conditionsString .= "`$conditionedField` = :$conditionedField AND";
        }
        $conditionsString = substr($conditionsString , 0, -4);

        // Preparing Statement
        $statement = $this->prepare("DELETE FROM {$table} WHERE $conditionsString");

        // Binding conditionals
        foreach ($conditions as $conditionedField => $conditionalValue)
        {
            $statement->bindValue(":{$conditionedField}", $conditionalValue);
        }

        // Action!
        $statement->execute();
    }
}