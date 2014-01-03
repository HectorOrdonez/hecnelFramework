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
use engine\Input;
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
        $this->_view->addLibrary('js', 'application/views/tests/test3/js/test3.js');
        $this->_view->addLibrary('css', 'application/views/tests/test3/css/test3.css');

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

            echo json_encode(array('id' => 123));
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
        $dog = new \stdClass();
        $dog->id = '123';
        $dog->name = 'Jimmy';
        $dog->age = '15';
        $dog->breed = 'German Sheppard';

        $dogData = array();
        $dogData['id'] = $dog->id;
        $dogData['name'] = $dog->name;
        $dogData['age'] = $dog->age;
        $dogData['breed'] = $dog->breed;

        echo json_encode($dogData);
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

        } catch (RuleException $rEx) {
            header("HTTP/1.1 400 Could not delete a dog.");
            echo json_encode(array('errorMessage' => $rEx->getMessage()));
        }
    }
}