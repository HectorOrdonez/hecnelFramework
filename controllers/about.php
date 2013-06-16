<?php
/**
 * Project: Furgoweb
 * User: Hector Ordonez
 * Date: 11/06/13 11:20
 */

class About extends Controller
{
    private $currentVersion = '1.1 (under construction)';
    private $releaseDate = 'Unknown';

    private $currentReleaseFeatures = array(
        'Improved Bootstrap in order to avoid broken links like http://localhost/furgoweb/index/%0../../. ',
        'Expanded already constructed Database flexibility for the use of Selects and Deletes.'
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