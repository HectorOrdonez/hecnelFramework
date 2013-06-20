<?php
/**
 * Project: Furgoweb
 * User: Hector Ordonez
 * Date: 11/06/13 11:20
 */

class About extends Controller
{
    private $currentVersion = '1.3';

    private $releaseDate = '20/06/2013';

    private $currentReleaseFeatures = array(
        'Improved Bootstrap for a stronger control of requests, refactoring the logic, making it nicer, more readable, more structured.',
        'Added Setting configuration in Bootstrap, allowing this framework to be used by different applications, models, databases, etc...',
        'Minor refactor in System config file and as a consequence minor changes in the whole project',
        'Changes in .htaccess; implemented security, forbidding direct access to php files.',
        'Implemented new Error system for 401, 403, 404 and 500 Apache errors'
    );

    /**
     * About constructor.
     */
    public function __construct($model)
    {
        parent::__construct($model);

    }

    /**
     * About main page.
     */
    public function index()
    {

        $newFeaturesString = '';
            foreach ($this->currentReleaseFeatures as $newFeature)
            {
                $newFeaturesString .= $newFeature . '<br />';
            }

            $this->_view->setParameter('currentVersion', $this->currentVersion);
            $this->_view->setParameter('releaseDate', $this->releaseDate);
            $this->_view->setParameter('news', $newFeaturesString);

        $this->_view->render('about/index');
    }
}