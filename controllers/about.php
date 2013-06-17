<?php
/**
 * Project: Furgoweb
 * User: Hector Ordonez
 * Date: 11/06/13 11:20
 */

class About extends Controller
{
    private $currentVersion = '1.2';
    private $releaseDate = '17/06/2013';

    private $currentReleaseFeatures = array(
        'Form data collection system.',
        'Data validation that works both together with Form and standalone.'
    );

    /**
     * About constructor.
     */
    public function __construct()
    {
        parent::__construct();
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

            $this->view->setParameter('currentVersion', $this->currentVersion);
            $this->view->setParameter('releaseDate', $this->releaseDate);
            $this->view->setParameter('news', $newFeaturesString);

        $this->view->render('about/index');
    }
}