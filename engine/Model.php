<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Description:
 * The Model class of the Engine is the master of the Models, extended by the Model of the application engine and, that one, extended by all the models that the Application needs.
 * A Model is the logical representation of a Database entity; it easies the Libraries task of requesting data to the Database.
 * @date: 11/06/13 12:30
 */

namespace engine;

/**
 * Class Model
 * @package engine
 */
class Model
{
    /**
     * Contains the required list of fields this Model has.
     * @var array
     */
    protected $fields = array();

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
    }

    /**
     * Adds a field to this Model fields.
     * @param string $name Field 
     */
    protected function addField($name)
    {
        $this->fields[] = $name;
    }

    /**
     * Returns a list of this Model's required fields 
     * @return array Fields
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * Finds the first record of this Model that fulfills the given conditions and options (if any)  
     * 
     */
    public function find($conditions = array(), DatabaseOptions $options)
    {
        
    }

    /**
     * Fills this Model object with the given data. 
     */
    public function populate($data)
    {
        
    }

    /**
     * Requests to the Data storing system to save the data of this Model.
     * The behave of this method depends on whether the object is a new one or the changes are being updated.
     */
    public function save()
    {

    }

    /**
     * Indicates that this Model is linked with another one. 
     */
    public function join(Model $linkedModel)
    {
        
    }

    /**
     * Verifies that this Model contains valid parameters in all fields 
     */
    protected function validate()
    {

    }
}