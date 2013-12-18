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
                 * @var $inputErrors RuleException[]
                 */
                foreach ($inputErrors as $ruleException) {
                    $response .= 'Fieldname ' . $fieldName . ' rule ' . $ruleException->getViolatedRule() . ' is broken by value ' . $ruleException->getIncorrectValue() . ', which gives exception message ' . $ruleException->getMessage() . '</br></br>';
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
        try {
            $inputUser->validate();
            $inputCity->validate();
        } catch (RuleException $rEx)
        {
            $errorMessage = 'Fieldname ' . $rEx->getInput()->getFieldName() . ' rule ' . $rEx->getViolatedRule() . ' is broken by value ' . $rEx->getIncorrectValue() . ', which gives exception message ' . $rEx->getMessage() . '</br></br>';
        }

        if (!isset($errorMessage)) {
            $response = 'No errors. Username : ' . $inputUser->getValue() .', City ' . $inputCity->getValue() . '.';
        } else {
            $response = $errorMessage;
        }

        // Answer
        $this->_view->setParameter('response', $response);
        $this->_view->addChunk('tests/test2/answerInputTest');
    }
}