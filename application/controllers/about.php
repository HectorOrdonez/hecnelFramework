<?php
/**
 * Project: Furgoweb
 * User: Hector Ordonez
 * Date: 11/06/13 11:20
 */

namespace application\controllers;

use engine\Controller;

class About extends Controller
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
        $this->_setDevelopmentVersion('1.5', '26/06/2013', array(
            'Factorized the Framework, using Engine folder and Application folder.',
            'Implemented use of Namespaces for the autoload of all files.'
        ));

        // Setting Historical Log of releases
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
            'Improved Bootstrap in order to avoid broken links like http://localhost/furgoweb/index/%0../../. ',
            'Expanded already constructed Database flexibility for the use of Selects and Deletes.',
            'Form data collection system.',
            'Data validation that works both together with Form and standalone.'
        ));

        $this->_addHistoryLog('1.1', '16/06/2013', array(
            'Improved Bootstrap in order to avoid broken links like http://localhost/furgoweb/index/%0../../.',
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