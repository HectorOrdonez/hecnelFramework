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
use engine\drivers\Exceptions\ModelException;
use engine\drivers\Exceptions\RuleException;

class Test3 extends Controller
{
    /**
     * Test3 constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->_view->addLibrary('application/views/tests/test3/js/test3.js');
        $this->_view->addLibrary('application/views/tests/test3/css/test3.css');

        $this->_view->addChunk('tests/test3/index');
    }

    /**
     * CRUD - Create
     */
    public function makeADog()
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
            
            $dog = Dog::create(array(
                'name' => $inputDogName->getValue(),
                'age' => $inputDogAge->getValue(),
                'breed' => $inputDogBreed->getValue()
            ));

            echo json_encode(array('id' => $dog->id));
        } catch (RuleException $rEx) {
            header("HTTP/1.1 400 Could not make a dog.");
            echo json_encode(array('errorMessage' => $rEx->getMessage()));
        }
    }

    /**
     * CRUD - Read
     */
    public function getADog()
    {
        $dog = Dog::first();
        echo json_encode($dog->attributes());
    }

    /**
     * CRUD - Update
     */
    public function changeADog()
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
            
            $dog = Dog::find(array('id'=> $inputDogId->getValue()));
            
            $dog->name = $inputDogName->getValue();
            $dog->age = $inputDogAge->getValue();
            $dog->breed = $inputDogBreed->getValue();
            $dog->save();

        } catch (RuleException $rEx) {
            header("HTTP/1.1 400 Could not change a dog.");
            echo json_encode(array('errorMessage' => $rEx->getMessage()));
        }
    }

    /**
     * CRUD - Delete
     */
    public function sayByeToADog()
    {
        $inputDogId = Input::build('Number', 'dogId')
            ->addRule('min', 1)
            ->addRule('isInt');

        try {
            $inputDogId->validate();

            $dog = Dog::find(array('id' => $inputDogId->getValue()));
            $dog->delete();

        } catch (RuleException $rEx) {
            header("HTTP/1.1 400 Could not delete a dog.");
            echo json_encode(array('errorMessage' => $rEx->getMessage()));
        }
    }
}