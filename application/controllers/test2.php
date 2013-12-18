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
use engine\Form;
use engine\Input;
use engine\drivers\Exception;
use engine\drivers\Exceptions\InputException as InputException;
use engine\drivers\Inputs\Text;


class Test2 extends Controller
{
    /**
     * Test2 constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->_view->addChunk('tests/test2/index');
    }

    public function runFormTest()
    {
        // Validation
        $form = new Form();
        $form->addInput(Input::build(
                'Text', 'username')
                ->addRule('minLength', 3)
                ->addRule('maxLength', 10)
        );
        $form->addInput(Input::build(
                'Text', 'city')
                ->addRule('minLength', 3)
                ->addRule('maxLength', 15)
        );

        // Logic        
        $wrongInputs = $form->getValidationErrors();

        if (FALSE === $wrongInputs) {
            $response = 'No errors. Random stuff : ' . $form->getInput('username')->getValue();
        } else {
            $response = 'yep, ERRORS! </br></br>';
            foreach ($wrongInputs as $fieldName => $inputErrors) {
                /**
                 * Form delivers an array of arrays. Each of these arrays is an array of InputExceptions that this
                 * specific Input with a specific field name has.
                 * @var $inputErrors InputException[]
                 */
                foreach ($inputErrors as $inputException) {
                    $response .= 'Fieldname ' . $fieldName . ' rule ' . $inputException->getViolatedRule() . ' is broken by value ' . $inputException->getIncorrectValue() . ', which gives exception message ' . $inputException->getMessage() . '</br></br>';
                }
            }
        }

        // Answer
        $this->_view->setParameter('response', $response);
        $this->_view->addChunk('tests/test2/answerFormTest');
    }
    public function runInputTest()
    {
        // Validation
        $inputUser = Input::build('Text', 'username')
            ->addRule('minLength', 3)
            ->addRule('maxLength', 10);
        
        $inputCity = Input::build('Text', 'city')
            ->addRule('minLength', 3)
            ->addRule('maxLength', 15);

        // Logic
        $response = false;
        try {
            $inputUser->validate();
            $inputUser->validate();
        } catch (InputException $iEx)
        {
            $response = 'Fieldname ' . $iEx->getInputName() . ' rule ' . $iEx->getViolatedRule() . ' is broken by value ' . $iEx->getIncorrectValue() . ', which gives exception message ' . $iEx->getMessage() . '</br></br>';
        }

        if (FALSE === $response) {
            $response = 'No errors.';
        } else {
        }

        // Answer
        $this->_view->setParameter('response', $response);
        $this->_view->addChunk('tests/test2/answerInputTest');
    }
}