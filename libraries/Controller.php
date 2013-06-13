<?php
/**
 * Project: Furgoweb
 * User: Hector Ordonez
 * Date: 11/06/13 11:59
 */

class Controller
{
    protected $view = NULL;
    protected $model = NULL;

    public function __construct()
    {
        Session::init();
        $this->view = new View();
        $this->loadModel();
    }

    /**
     * Auto-loading of the model method.
     * Checks if there is a model related to this controller and, if so, instantiates it.
     */
    private function loadModel()
    {
        $className = lcfirst(get_class($this));

        $modelPath = 'models/'.$className.'_model.php';
        if(file_exists($modelPath))
        {
            require $modelPath;
            $modelName = $className . '_Model';
            $this->model = new $modelName();
        }
    }
}