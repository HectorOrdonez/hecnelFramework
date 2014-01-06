<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Description:
 * Testing page.
 * Date: 12/12/13 23:00
 */

namespace application\controllers;

use application\engine\Controller;
use application\models\Dog;
use engine\Input;
use engine\ModelCollection;
use engine\drivers\Exceptions\ModelException;
use engine\drivers\Exceptions\RuleException;

class Test4 extends Controller
{
    /**
     * Test4 constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->_view->addLibrary('js', 'application/views/tests/test4/js/test4.js');
        $this->_view->addLibrary('css', 'application/views/tests/test4/css/test4.css');
        
        $this->_view->addChunk('tests/test4/index');
    }

    /**
     * CRUD - Create
     */
    public function createDogs()
    {
        $inputDogName = Input::build('Text', 'dogName')
            ->addRule('minLength', 3)
            ->addRule('maxLength', 12);
        $inputDogAge = Input::build('Number', 'dogAge')
            ->addRule('min', 0)
            ->addRule('max', 100)
            ->addRule('isInt');
        $inputDogBreed = Input::build('Select', 'dogBreed')
            ->addRule('availableOptions', array(
                'germanSheppard',
                'siberianHusky',
                'biggles',
                'borderCollie'
            ));

        try {
            $inputDogName->validate();
            $inputDogAge->validate();
            $inputDogBreed->validate();

            $dogCollection = new ModelCollection(new Dog);
            $dogCollection->
            $dog->name = $inputDogName->getValue();
            $dog->age = $inputDogAge->getValue();
            $dog->breed = $inputDogBreed->getValue();
            $dog->save();

            echo json_encode(array('id' => $dog->getId()));
        } catch (RuleException $rEx) {
            header("HTTP/1.1 400 Could not make a dog.");
            echo json_encode(array('errorMessage' => $rEx->getMessage()));
        }
    }

    /**
     * CRUD - Read
     */
    public function getDoggies()
    {
        try {
            $dog = new Dog();
            $dog->find();
        } catch (ModelException $mEx) {
            switch ($mEx->getCode()) {
                case Dog::ERR_RECORDS_FOUND:
                    header("HTTP/1.1 400 Could not find a dog.");
                    echo json_encode(array('errorMessage' => 'Could not find a dog.'));
                    exit;
                    break;
                default:
                    header("HTTP/1.1 400 Could not make a dog.");
                    echo json_encode(array('errorMessage' => 'Unexpected error: ' . $mEx->getMessage()));
                    exit;
            }
        }

        echo json_encode($dog->toArray());
    }

    /**
     * CRUD - Update
     */
    public function changeDogs()
    {
        $inputDogId = Input::build('Number', 'dogId')
            ->addRule('min', 1)
            ->addRule('isInt');
        $inputDogName = Input::build('Text', 'dogName')
            ->addRule('minLength', 3)
            ->addRule('maxLength', 12);
        $inputDogAge = Input::build('Number', 'dogAge')
            ->addRule('min', 0)
            ->addRule('max', 100)
            ->addRule('isInt');
        $inputDogBreed = Input::build('Select', 'dogBreed')
            ->addRule('availableOptions', array(
                'germanSheppard',
                'siberianHusky',
                'biggles',
                'borderCollie'
            ));

        try {
            $inputDogId->validate();
            $inputDogName->validate();
            $inputDogAge->validate();
            $inputDogBreed->validate();

            $dog = new Dog();
            $dog->find(array('id' => $inputDogId->getValue()));
            $dog->name = $inputDogName->getValue();
            $dog->age = $inputDogAge->getValue();
            $dog->breed = $inputDogBreed->getValue();
            $dog->save();

        } catch (RuleException $rEx) {
            header("HTTP/1.1 400 Could not change a dog.");
            echo json_encode(array('errorMessage' => $rEx->getMessage()));
        } catch (ModelException $mEx) {
            switch ($mEx->getCode()) {
                case Dog::ERR_RECORDS_FOUND:
                    header("HTTP/1.1 400 Dog does not exist.");
                    echo json_encode(array('errorMessage' => 'Dog you are trying to change does not exist.'));
                    exit;
                    break;
                default:
                    header("HTTP/1.1 400 Could not change a dog.");
                    echo json_encode(array('errorMessage' => 'Unexpected error: ' . $mEx->getMessage()));
                    exit;
            }
        }
    }

    /**
     * CRUD - Delete
     */
    public function dogMassacre()
    {
        $inputDogId = Input::build('Number', 'dogId')
            ->addRule('min', 1)
            ->addRule('isInt');

        try {
            $inputDogId->validate();

            $dog = new Dog();
            $dog->find(array('id' => $inputDogId->getValue()));
            $dog->delete();

        } catch (RuleException $rEx) {
            header("HTTP/1.1 400 Could not delete a dog.");
            echo json_encode(array('errorMessage' => $rEx->getMessage()));
        } catch (ModelException $mEx) {
            switch ($mEx->getCode()) {
                case Dog::ERR_RECORDS_FOUND:
                    header("HTTP/1.1 400 Dog does not exist.");
                    echo json_encode(array('errorMessage' => 'Dog you are trying to delete does not exist.'));
                    exit;
                    break;
                default:
                    header("HTTP/1.1 400 Could not delete a dog.");
                    echo json_encode(array('errorMessage' => 'Unexpected error: ' . $mEx->getMessage()));
                    exit;
            }
        }
    }
}