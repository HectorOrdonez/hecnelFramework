<?php
/**
 * Project: Furgoweb
 * User: Hector Ordonez
 * Date: 11/06/13 11:59
 *
 * @todo - Use configurable paths to Views, so an application can set which project contains the required view.
 */

class Controller
{
    /**
     * Property view
     * @var null|View
     */
    protected $_view = NULL;

    /**
     * @var null
     */
    protected $_model = NULL;

    /**
     * Initializes the User Session.
     * Initializes the View and the Model.
     *
     * @param string $modelsFolder Place in which this Controller can search for the Model
     */
    public function __construct($modelsFolder)
    {
        Session::init();
        $this->_setView();
        $this->_setModel($modelsFolder);
    }

    private function _setView()
    {
        $this->_view = new View();
    }
    /**
     * Auto-loading of the model method.
     * Checks if there is a model related to this controller and, if so, instantiates it.
     *
     * @param string $modelsFolder Place in which this Controller can search for the Model
     */
    private function _setModel($modelsFolder)
    {
        $modelName = lcfirst(get_class($this));
        $modelFilePath = $modelsFolder . $modelName . '_model.php';

        if(file_exists($modelFilePath))
        {
            require $modelFilePath;
            $modelName = $modelName . '_Model';
            $this->_model = new $modelName();
        }
    }
}