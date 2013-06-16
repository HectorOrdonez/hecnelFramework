<?php
/**
 * Project: Furgoweb
 * User: Hector Ordonez
 * Date: 11/06/13 11:20
 */

class About extends Controller
{
    private $currentVersion = '1.0';
    private $releaseDate = '16/06/2013';

    private $currentReleaseFeatures = array(
        'Added flexibility to Database engine.',
        'Improved comments in several files.',
        'Styled Help page with specific CSS file (tested specific CSS files usage).',
        'Created release log.'
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