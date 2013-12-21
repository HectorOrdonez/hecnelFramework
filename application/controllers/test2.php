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
use engine\drivers\Exceptions\RuleException as RuleException;
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

        $form->addInput(
            $inputUser = Input::build('Text', 'username')
                ->addRule('minLength', 3)
                ->addRule('maxLength', 10)
        );

        $form->addInput(
            $inputCity = Input::build('Text', 'city')
                ->addRule('minLength', 3)
                ->addRule('maxLength', 15)
        );

        $form->addInput(
            $inputAge = Input::build('Int', 'age')
                ->addRule('min', 1)
                ->addRule('max', 100)
        );

        $form->addInput(
            $inputNegative = Input::build('Int', 'negative')
                ->addRule('min', -100)
                ->addRule('max', -1)
        );
        
        // Logic        
        $wrongInputs = $form->getValidationErrors();
        
        // Output
        if (FALSE === $wrongInputs) {
            $response = 'No errors. Username: ' . $form->getInput('username')->getValue() . ', City: ' . $form->getInput('city')->getValue() . ', Age : ' . $form->getInput('age')->getValue() . ' and negative amount: ' . $form->getInput('negative')->getValue();

            $this->_view->setParameter('response', $response);
            $this->_view->addChunk('tests/test2/answerFormTest');
        } else {
            $errors = array();
            foreach ($wrongInputs as $invalidInput) {
                $errors[] = 'Fieldname ' . $invalidInput->getFieldName(). ' rule ' . $invalidInput->getError()->getViolatedRule() . ' is broken by value ' . $invalidInput->getError()->getIncorrectValue() . ', which gives exception message ' . $invalidInput->getError()->getMessage();
            }
            $this->_view->setParameter('errors', $errors);
            $this->_view->addChunk('tests/test2/errorFormTest');
        }
    }

    public function runInputTest()
    {
        try {
            // Validation
            $inputUser = Input::build('Text', 'username')
                ->addRule('minLength', 3)
                ->addRule('maxLength', 10);
            $inputCity = Input::build('Text', 'city')
                ->addRule('minLength', 3)
                ->addRule('maxLength', 15);
            $inputAge = Input::build('Int', 'age')
                ->addRule('min', 1)
                ->addRule('max', 100);
            $inputNegative = Input::build('Int', 'negative')
                ->addRule('min', -100)
                ->addRule('max', -1);

            $inputUser->validate();
            $inputCity->validate();
            $inputAge->validate();
            $inputNegative->validate();

            // Logic 
            $response = 'No errors. Username : ' . $inputUser->getValue() . ', City ' . $inputCity->getValue() . ' and Age: ' . $inputAge->getValue() . ', negative input: ' . $inputNegative->getValue();

            // Output
            $this->_view->setParameter('response', $response);
            $this->_view->addChunk('tests/test2/answerInputTest');

        } catch (InputException $iEx) {
            $errorMessage = 'Input error: ' . $iEx->getMessage();

            $this->_view->setParameter('error', $errorMessage);
            $this->_view->addChunk('tests/test2/errorInputTest');
        } catch (RuleException $rEx) {
            $errorMessage = 'Invalid data: ' . $rEx->getMessage();

            $this->_view->setParameter('error', $errorMessage);
            $this->_view->addChunk('tests/test2/errorInputTest');
        }
    }
}