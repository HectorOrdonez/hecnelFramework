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
        $this->_setDevelopmentVersion('2.02', '12/12/2013', array(
            '[Feature] - Added Testing selection in top menu.',
            '[Feature] - Created Test 1, 2, 3 and 5 for future feature testings.',
            '[Refactor] - Moved index logic to test 1, as it was a test for views. Now index is a simple hello.',
            '[Refactor] - Header and footers are set in the Controller, who has to set them for the View. Changes have been done to follow this logic.'
        ));

        // Setting Historical Log of releases
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
        $this->_releaseLogHistory[$version] = array (
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