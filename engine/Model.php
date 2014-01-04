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

use engine\drivers\Exceptions\ModelException;

/**
 * Class Model
 * @package engine
 */
class Model
{
    const FIRST_RECORD = 0;

    const ERR_INCOMPLETE_POPULATE = 501;
    const ERR_RECORDS_FOUND= 502;
    
    const MSG_INCOMPLETE_POPULATE = 'Could not populate object %s; Data field %s was not provided.';
    const MSG_NO_RECORDS_FOUND = 'Could not find any %s record.';

    /**
     * Model name as to be referenced to the Database.
     * @var string $modelName
     */
    protected $modelName;

    /**
     * Contains the required list of fields this Model has.
     * @var array
     */
    protected $fields = array();

    /**
     * Model Id.
     * This field is required in all models.
     * @var int
     */
    protected $id = null;

    /**
     * Database instance to use.
     * @var DBInterface
     */
    protected $db;
    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->addField('id');

        $this->setDb(Database::getInstance(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS));
    }

    /**
     * @param DBInterface $db
     */
    public function setDb(DBInterface $db)
    {
        $this->db = $db;
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
    public function find($conditions = array(), DatabaseOptions $options = null)
    {
        $records = $this->db->select($this->getModelName(), $this->getFields(), $conditions, $options);

        if (0 === sizeof($records)) {
            throw new ModelException(sprintf(self::MSG_NO_RECORDS_FOUND, $this->getModelName()), ModelException::GENERAL_EXCEPTION, self::ERR_RECORDS_FOUND);
        }

        $this->populate($records[self::FIRST_RECORD]);
    }

    /**
     * Requests the DB to delete this Model, if it is stored, and empties all parameters.
     */
    public function delete()
    {
        // Deleting record from DB
        if (!$this->isNew())
        {
            $this->db->delete($this->getModelName(), array('id' => $this->getId()));
        }
        
        // Resetting parameters
        foreach($this->getFields() as $field)
        {
            $this->$field = null;
        }
    }

    /**
     * Fills this Model object with the given data.
     */
    public function populate($data)
    {
        foreach ($this->getFields() as $field) {
            if (!isset($data[$field])) {
                throw new ModelException(sprintf(self::MSG_INCOMPLETE_POPULATE, $this->getModelName(), $data[$field]), ModelException::GENERAL_EXCEPTION, self::ERR_INCOMPLETE_POPULATE);
            }
            $this->$field = $data[$field];
        }
    }

    /**
     * Requests to the Data storing system to save the data of this Model.
     * The behave of this method depends on whether the object is a new one or the changes are being updated.
     */
    public function save()
    {
        $this->validate();

        $data = $this->toArray();
        unset($data['id']);

        if ($this->isNew()) {
            $newId = $this->db->insert($this->getModelName(), $data);
            $this->setId($newId);
        } else {
            $this->db->update($this->getModelName(), $data, array('id' => $this->getId()));
        }
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

    /**
     * @param string $modelName
     */
    protected function setModelName($modelName)
    {
        $this->modelName = $modelName;
    }

    /**
     * @return string
     */
    protected function getModelName()
    {
        return $this->modelName;
    }

    /**
     * Builds an array with this model fields as keys containing the related values.
     * @return array
     */
    public function toArray()
    {
        $array = array();

        foreach ($this->getFields() as $field) {
            $array[$field] = $this->$field;
        }

        return $array;
    }

    /**
     * Notice that use of this method without understanding the Model might lead to unexpected behavior.
     * A new Model object has no Id, which is the way a Model knows whether request the Database to create it or to update it!
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Tells whether this object is new or not.
     * @return bool
     */
    public function isNew()
    {
        return is_null($this->getId());
    }
}