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
            $inputAge = Input::build('Number', 'age')
                ->addRule('min', 1)
                ->addRule('max', 100)
                ->addRule('isInt')
        );

        $form->addInput(
            $inputNegative = Input::build('Number', 'negative')
                ->addRule('min', -100)
                ->addRule('max', -1)
        );

        $form->addInput(
            $inputMail = Input::build('Mail', 'mail')
        );

        $form->addInput(
            $inputConditions = Input::build('Checkbox', 'conditions')
        );

        $form->addInput(
            $inputDogs = Input::build('Select', 'dogs')
                ->addRule('availableOptions', array(
                    '1',
                    '2'
                ))
        );

        $form->addInput(
            $inputDays = Input::build('Multiselect', 'days')
                ->addRule('availableOptions', array(
                    'md',
                    'td',
                    'wd',
                    'th',
                    'fd',
                    'st',
                    'sn'
                ))
                ->addRule('minOptions', 2)
                ->addRule('maxOptions', 5)
        );

        $form->addInput(
            $inputDeath = Input::build('Date', 'death')
                ->addRule('minDate', '01/01/1980')
                ->addRule('maxDate', '01/01/2080')
        );

        // Logic        
        $wrongInputs = $form->getValidationErrors();

        // Output
        if (FALSE === $wrongInputs) {
            $response = '<b>No errors</b> <br>' .
                'Username: ' . $form->getInput('username')->getValue() . ', <br>' .
                'City: ' . $form->getInput('city')->getValue() . '<br>' .
                'Age : ' . $form->getInput('age')->getValue() . '<br>' .
                'Negative amount: ' . $form->getInput('negative')->getValue() . '<br>' .
                'Mail: ' . $form->getInput('mail')->getValue() . '<br>' .
                'Conditions read: ' . (($form->getInput('conditions')->getValue()) ? 'yes' : 'no') . '<br>' .
                'You like dogs : ' . $form->getInput('dogs')->getValue() . '<br>' .
                'Days : ' . serialize($form->getInput('days')->getValue()) . '<br>' .
                'Death date : ' . $form->getInput('death')->getValue() . '<br>';

            $this->_view->setParameter('response', $response);
            $this->_view->addChunk('tests/test2/answerFormTest');
        } else {
            $errors = array();
            foreach ($wrongInputs as $invalidInput) {
                $errors[] = 'Field name ' . $invalidInput->getFieldName() . ' rule ' . $invalidInput->getError()->getViolatedRule() . ' is broken by value ' . $invalidInput->getError()->getIncorrectValue() . ', which gives exception message ' . $invalidInput->getError()->getMessage();
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
            $inputAge = Input::build('Number', 'age')
                ->addRule('min', 1)
                ->addRule('max', 100)
                ->addRule('isInt');
            $inputNegative = Input::build('Number', 'negative')
                ->addRule('min', -100)
                ->addRule('max', -1);
            $inputMail = Input::build('Mail', 'mail');
            $inputConditions = Input::build('Checkbox', 'conditions');
            $inputDogs = Input::build('Select', 'dogs')
                ->addRule('availableOptions', array(
                    '1',
                    '2'
                ));
            $inputDays = Input::build('Multiselect', 'days')
                ->addRule('availableOptions', array(
                    'md',
                    'td',
                    'wd',
                    'th',
                    'fd',
                    'st',
                    'sn'
                ))
                ->addRule('minOptions', 2)
                ->addRule('maxOptions', 5);

            $inputDeath = Input::build('Date', 'death')
                ->addRule('minDate', '01/01/1980')
                ->addRule('maxDate', '01/01/2080');

            $inputUser->validate();
            $inputCity->validate();
            $inputAge->validate();
            $inputNegative->validate();
            $inputMail->validate();
            $inputConditions->validate();
            $inputDogs->validate();
            $inputDays->validate();
            $inputDeath->validate();

            // Logic 
            $response = '<b>No errors</b> <br>' .
                'Username: ' . $inputUser->getValue() . ', <br>' .
                'City: ' . $inputCity->getValue() . '<br>' .
                'Age : ' . $inputAge->getValue() . '<br>' .
                'Negative amount: ' . $inputNegative->getValue() . '<br>' .
                'Mail: ' . $inputMail->getValue() . '<br>' .
                'Conditions: ' . (($inputConditions->getValue()) ? 'yes' : 'no') . '<br>' .
                'You like dogs: ' . $inputDogs->getValue() . '<br>' .
                'Days: ' . serialize($inputDays->getValue()) . '<br>' .
                'Death: ' . $inputDeath->getValue() . '<br>';

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