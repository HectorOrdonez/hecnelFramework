<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Date: 11/06/13 11:20
 */

namespace application\controllers;

use application\engine\Controller;

class ReleaseLog extends Controller
{
    /**
     * Array of Arrays.
     * @var array
     */
    private $_releaseLogHistory;

    /**
     * Array of Strings
     * @var
     */
    private $_developmentVersion;

    /**
     * About constructor.
     */
    public function __construct()
    {
        parent::__construct();

        // Setting version under construction
        $this->_setDevelopmentVersion('3.01', '31/03/2014', array(
            '[Feature] - Implemented Cron Job support.',
            '[Feature] - Logging system',
            '[Refactor] - Exceptions now are stored in files depending on their type: error, info, debug.',
        ));

        // Setting Historical Log of releases
        $this->_addHistoryLog('3.003', '11/02/2014', array(
            '[Debug] - Input object invalid value message contained errors. Fixed.',
            '[Debug] - PHP ActiveRecord Model object method find_by_pk required options. Made it optional. Fixed.',
        ));
        $this->_addHistoryLog('3.002', '17/01/2014', array(
            '[Debug] - Issue with Bootstrap - Separator / works in Windows environment but not Unix. It is better, I think, having the the controller route hardcoded - The controllers application folder is always going to be like that!'
        ));
        $this->_addHistoryLog('3.001', '07/01/2014', array(
            '[Code improvement] - Minor change in the autoload.'
        ));
        $this->_addHistoryLog('2.24', '06/01/2014', array(
            '[Refactor] - Mayor change. After intense struggles and researches, decided to use PHP ActiveRecord. Because of this, deleted all Database and Model related constructions used so far. I am aiming to implement my own PHP ActiveRecord technology for the third Hecnel Framework version.',
            '[Feature] - Test 4 is designed to be the testing workspace for multiple model work. However, as PHP ActiveRecord comes to play, it is halfway implemented. To be reworked in future.',
        ));
        $this->_addHistoryLog('2.23', '04/01/2014', array(
            '[Refactor] - Modified libraries concept to Service concepts. A Service is tightly related to a controller. It stores intelligence regarding what to do with validated information, which models request a CRUD, and informs the controller about the message to put into the related view.',
            '[Refactor] - Modified Hecnel Framework in order to use the new Model architecture.'
        ));
        $this->_addHistoryLog('2.22', '04/01/2014', array(
            '[Refactor] - Mayor change in Model architecture. Now all models extend the same Model object, which handles all commands that a Model offers and instantiates and communicates with the Database.',
            '[Refactor] - Major change in Database architecture. Now it is allowed to have different storing systems.',
            '[Feature] - New database system: Mock Database. Basically a database that always says yes, always returns data. For development purposes.',
            '[Feature] - New Model Exception. When caught, its code indicates what happened. ',
            '[Feature] - Connected Test3 to models. It allows CRUD to Dog, plus model exceptions catching and error display.'
        ));
        $this->_addHistoryLog('2.21', '03/01/2014', array(
            'HAPPY NEW YEAR!!',
            '[Feature] - Created basic skeleton for the new Model architecture.',
            '[Feature] - Sample page Test 3 is a CRUD for model Dog. This page is design to help building the new Model architecture and to document in future term the usage of the models.',
            '[Refactor] - Minor change in JQuery location; created a folder "external" in public section.'
        ));
        $this->_addHistoryLog('2.11', '27/12/2013', array(
            '[Feature] - New Getter in View to access View parameters',
            '[Refactor] - Refactored Hecnel Framework to use View getter instead of direct access to parameters. Added, as well, PHPDoc comments in all View related files, as part of View class.'
        ));
        $this->_addHistoryLog('2.10', '26/12/2013', array(
            '[Refactor] - New View system. Allows Views inside Views besides a better view construction.',
            '[Feature] - Sample page Test 1 explains how to use this new implementation and shows a practical example as well ',
            '[Refactor] - Refactored Hecnel Framework to use new View construction where it was using Views.',
            '[Refactor] - Removed Autorender feature, as it is required no more thanks of the new View construction.'
        ));
        $this->_addHistoryLog('2.03G', '26/12/2013', array(
            '[Feature] - New Inputs Date, Checkbox, Select and Multiselect.',
            '[Code improvement] - Modified already build Inputs Text, Number and Mail in order to use same logic in all Input constructors: constructor method uses set private method that knows logic to follow for each Input construction.',
            '[Feature] - Extended Test2 page in order to provide a way to test the Form and the Inputs.',
            '[Refactor] - Removed remaining Validators.'
        ));
        $this->_addHistoryLog('2.03F', '24/12/2013', array(
            '[Refactor] - Minor refactor of Input construction on current Input objects Text, Number and Mail.',
            '[Code improvement] - Modified and reorganized comments here and there.',
            '[Code improvement] - Reorganized code using PHPStorm tool "Reformat code".'
        ));
        $this->_addHistoryLog('2.03E', '23/12/2013', array(
            '[Debug] - Fixed bug with Text Input.',
            '[Feature] - New Input type: Mail.',
            '[Feature] - Modified Input construction, now it does not allow rules.',
            '[Code improvement] - Replaced string messaging in Inputs for Constants.',
            '[Refactor] - Removed refactored Validators Int (Number) and String (Text).'
        ));
        $this->_addHistoryLog('2.03D', '21/12/2013', array(
            '[Refactor] - Int Input changed to Number.',
            '[Feature] - Added Number validation for Spain number format notation.'
        ));
        $this->_addHistoryLog('2.031', '22/12/2013', array(
            '[ToDo] - Changed the Hecnel Framework To Dos, separating them into Version targets. Added UserSettings ToDo for Hecnel 3.0.'
        ));
        $this->_addHistoryLog('2.03C', '21/12/2013', array(
            '[Feature] - More work done in the Form - Input logic.',
            '[Refactor] - Refactored different parts of sample Application that uses form and inputs.',
            '[Feature] - Test2 now allows proper testing of new Form and Input features.',
        ));
        $this->_addHistoryLog('2.03B', '18/12/2013', array(
            '[Feature] - New Exception type RuleException. Refactored Form and Input to work with them. This allows to differentiate from Input exceptions, which are unexpected behaviors, from Rule exceptions, which are expected behaviors - User is inputted wrong stuff.'
        ));
        $this->_addHistoryLog('2.03A', '18/12/2013', array(
            '[Feature] - Modified Hecnel sample application in order to have testing pages.',
            '[Feature] - Build Test1 - Related to View Chunks and the View feature that allows chunk reorganization.',
            '[Feature] - Build Test2 - Related to Form and Input usage, which is a new mayor refactor.',
            '[Refactor] - New Exception structure, allows custom exception types in Exceptions folder, inside drivers.',
            '[Refactor] - Mayor Form and Validation system refactor. New object Input, which Form object works with, allows validations.',
            '[Visual improvement] - Minor style changes.',
            '[Etc] - This is an unfinished release.'
        ));
        $this->_addHistoryLog('2.02', '12/12/2013', array(
            '[Feature] - Added Testing selection in top menu.',
            '[Feature] - Created Test 1, 2, 3 and 5 for future feature testings.',
            '[Refactor] - Moved index logic to test 1, as it was a test for views. Now index is a simple hello.',
            '[Refactor] - Header and footers are set in the Controller, who has to set them for the View. Changes have been done to follow this logic.'
        ));
        $this->_addHistoryLog('2.01', '12/12/2013', array(
            '[Refactor] - Moved config files to application.'
        ));
        $this->_addHistoryLog('1.84', '22/11/2013', array(
            '[Debug] - Issue with Session Start - again.'
        ));
        $this->_addHistoryLog('1.83', '12/11/2013', array(
            '[Debug] - Issue with Session Start.',
            '[Code Improvement] - Added todos and pendings.'
        ));
        $this->_addHistoryLog('1.82', '09/08/2013', array(
            '[Refactor] - About page now is Release Log.',
            '[Code cleaning] - Cleaned "to does" in the project and summarized in the Index.',
            '[Debug] - Minor fix in the Exception that Int Validator was throwing when maximum validation fails.',
            '[Debug] - Minor issue in Database that was generating bad SQL strings for debugging.'
        ));
        $this->_addHistoryLog('1.81', '16/07/2013', array(
            'Fixed issues with Exceptions catching in the Bootstrap.',
            'Fixed issues where the core Exception class was thrown instead of the engine one.',
            'Fixed issues with the sample application.',
            'Minor changes in the CSS of the Error page for the sample application.',
            'Realized breach in the execute statement in Database Class, due to a bug in the UserModel. Make sure to print any exception from PDO to learn about how it might work in case of SQL issues.'
        ));
        $this->_addHistoryLog('1.8', '15/07/2013', array(
            'Upgraded PHP version to 5.5.',
            'Improvement: Database engine. Added debugging functionality and changed the basic CRUD methods to easier its use.',
            'Created an Exception system. Includes Exception engine and a change in the bootstrap that redirects exceptions uncaught to the Error controller. Built an Exception displayer in the Error controller with Exception and Exception Backtrace display.',
            'Updated Encrypter engine. With PHP 5.5 the previous version was deprecated. Newer version is easier to use, more secure and automatically updated with future php versions.',
            'Improved Bootstrap: now it try catches exceptions smartly even if fatal exceptions are found.'
        ));

        $this->_addHistoryLog('1.7', '11/07/2013', array(
            'Mayor improvement: application\engine. Now application uses engine objects that extends the engine objects of the framework. This allows customization of the behavior of the engine objects.',
            'Mayor improvement: using custom design patter MLVC, which uses Libraries to run logic, being the Controller used only to validate, call Library\'s logic and resolve its response, and the Model used only as a medium to use Database stuff.',
            'Mayor refactor: project now is called Hecnel Framework.',
            'Added comments and property declarations in key points: it helps PHPStorm understanding the expected logic and the Object relationships, which provides a stronger debugging experience! (awesome discovery!)',
            'Cleaned minor issues related to CSS, comments and others.'
        ));

        $this->_addHistoryLog('1.6', '10/07/2013', array(
            'Created a little snippet for config setup depending on whether the environment is production or not. Affects System and Database config files.',
            'Fixed Dashboard; asynchronous calls now works correctly.',
            'Added possibility to add external libraries in the View.'
        ));

        $this->_addHistoryLog('1.5', '26/06/2013', array(
            'Factorized the Framework, using Engine folder and Application folder.',
            'Implemented use of Namespaces for the autoload of all files.'
        ));

        $this->_addHistoryLog('1.4', '21/06/2013', array(
            'Changes in the About page. Now it shows an Historical Log of changes in the Framework and the version on development.',
            'Refactoring View library; private and protected functions and properties now uses underscore before property name.',
            'Improved View; now it works with "Chunk" concepts, so multiple view chunks can be used. It allows inserting the Chunks in a specific order.',
            'Modified View and Controller jurisdiction: JS and CSS libraries are added in the Controller, as the View should only allowed the controllers to use it.',
            'Added Meta feature in the View: now the general Header will write the Metas specified in the View by the Controllers.',
            'Modified Error page; a little Error CSS to show the improvements with the CSS and views.',
            'Modified Index page; use of multiple views with a specific order to show improvements with Chunks.'
        ));

        $this->_addHistoryLog('1.3', '20/06/2013', array(
            'Improved Bootstrap for a stronger control of requests, refactoring the logic, making it nicer, more readable, more structured.',
            'Added Setting configuration in Bootstrap, allowing this framework to be used by different applications, models, databases, etc...',
            'Minor refactor in System config file and as a consequence minor changes in the whole project',
            'Changes in .htaccess; implemented security, forbidding direct access to php files.',
            'Implemented new Error system for 401, 403, 404 and 500 Apache errors'
        ));

        $this->_addHistoryLog('1.2', '17/06/2013', array(
            'Improved Bootstrap in order to avoid broken links like http://localhost/hecnel/index/%0../../. ',
            'Expanded already constructed Database flexibility for the use of Selects and Deletes.',
            'Form data collection system.',
            'Data validation that works both together with Form and standalone.'
        ));

        $this->_addHistoryLog('1.1', '16/06/2013', array(
            'Improved Bootstrap in order to avoid broken links like http://localhost/hecnel/index/%0../../.',
            'Expanded already constructed Database flexibility for the use of Selects and Deletes.',
            'Changed use of table "users" to "user".',
            'Added several todo\'s.'
        ));

        $this->_addHistoryLog('1.0', '11/06/2013', array(
            'Skeleton of the MVC.'
        ));
    }

    /**
     * About main page.
     */
    public function index()
    {
        $this->_view->setParameter('developmentVersion', $this->_getDevelopmentVersion());
        $this->_view->setParameter('historicalLog', $this->_getHistoryLog());

        $this->_view->addChunk('about/index');
    }

    /**
     * @param string $version
     * @param string $date
     * @param array $changes. Array of changes (strings)
     */
    private function _addHistoryLog($version, $date, $changes)
    {
        $this->_releaseLogHistory[$version] = array(
            'version' => $version,
            'date' => $date,
            'changes' => $changes
        );
    }

    private function _getHistoryLog()
    {
        return $this->_releaseLogHistory;
    }

    private function _setDevelopmentVersion($version, $date, $changes)
    {
        $this->_developmentVersion = array(
            'version' => $version,
            'date' => $date,
            'changes' => $changes
        );
    }

    private function _getDevelopmentVersion()
    {
        return $this->_developmentVersion;
    }
}