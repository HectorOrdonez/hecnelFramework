<?php
/**
 * This class manages the collection of Post data, allowing validations.
 *
 * Project: Furgoweb
 * User: Hector Ordonez
 * Date: 16/06/13 21:42
 *
 * @todo Add exception trigger in the Fetch if data requested was not set.
 * @todo Add exception trigger in the requireParameter if the requested parameter is not set.
 * @todo Create a special Exception type that allows logic to filter the exceptions triggered by the Form.
 * @todo Form work with both Get and Post options.
 * @todo Validations have to allow Strict Mode as third optional parameter.
 */

namespace engine;

use engine\Validator as Validator;

class Form
{
    /**
     * Array of Posted parameters
     * @var array
     */
    private $_postData = array();

    /**
     * Current item. Allows adding Validation to the last item required.
     * @var string
     */
    private $_currentItem= NULL;

    /**
     * List of errors, if any.
     * @var array
     */
    private $_errors = array();
    /**
     * Validator object. Contains the Validator that allows this form to verify parameters with the specified rules.
     * @var object Validator
     */
    private $_validator;

    /**
     * Form constructor.
     */
    public function __construct()
    {
//        $this->_validator = new Validator();
    }

    /**
     * Sets the specified field as a required Post parameter.
     * Returns this form in order to allow concatenation.
     * @param string $field The HTML field name of the post.
     * @return $this
     */
    public function requireItem($field)
    {
        $this->_postData[$field] = $_POST[$field];
        $this->_currentItem = $field;
        return $this;
    }

    /**
     * Returns the specified parameter set in the Post.
     * @param string $field Name of the parameter required
     * @throws \Exception If Field did not pass validation.
     */
    public function fetch($field)
    {
        if (isset($this->_errors[$field]))
        {
            throw new \Exception ('Field ' . $field . ' did not pass Validation. Following error received: ' . $this->_errors[$field]);
        }
        return $this->_postData[$field];
    }

    /**
     * Sets validation control to the last parameter specified.
     * Returns this form in order to allow concatenation.
     * @param string $type Validation type of the object to be validated.
     * @param array $rules List of rules that the object must accomplished to be validated.
     * @return $this
     */
    public function validate($type, $rules=NULL)
    {
        try {
            Validator::$type($this->_postData[$this->_currentItem], $rules);
        }
        catch (Exception $e)
        {
            $this->addError($this->_currentItem, $e->getMessage());
        }

        return $this;
    }

    /**
     * Adds an error.
     * @param string $key Parameter that failed
     * @param string $explanation Why parameter did not pass validation.
     */
    private function addError($key, $explanation)
    {
        $this->_errors[$key] = $explanation;
    }

    /**
     * Returns errors array.
     * @return array Errors array.
     */
    public function getErrors()
    {
        return $this->_errors;
    }
}