<?php
/**
 * Bootstrap class. Initializes the application.
 *
 * The booting system implements some security - like allowing access to pages only if existing in the controllers folder - but for a complete
 * security implementation the .htaccess has to do its work.
 * At the moment of this writing I am aware of the following security points that this class does not fulfill and .htaccess must:
 * - Direct access to php files. .htaccess has to disable all requests to files with extension php.
 * - Access to folders. Same than before.
 *
 * Project: Furgoweb
 * User: Hector Ordonez
 * Date: 11/06/13 11:47
 *
 * @todo - Research possible security issues, regarding URL modifications.
 * @todo - Research null-byte injection.
 * @todo - Research what filter_var with FILTER_SANITIZE_URL option actually does.
 * @todo - Research if is possible to do directory traversal.
 * @todo - Ask why this class is a dynamic object instead of a static one.
 */

class Bootstrap
{
    /*************************************************/
    /** CONSTANT DEFINITIONS TO IMPROVE READABILITY **/
    /*************************************************/

    /**
     * Part of the URL related to the controller requested.
     */
    const URL_CONTROLLER = 0;

    /**
     * Part of the URL related to the method requested to the controller.
     */
    const URL_METHOD = 1;

    /**
     * Part of the URL related to the arguments passed to the method in the controller.
     */
    const URL_ARGUMENTS = 2;

    /*********************/
    /** SYSTEM SETTINGS **/
    /*********************/

    /**
     * In case of an error the following controller will be load.
     */
    private $_ERROR_CONTROLLER = 'error';

    /**
     * In case no controller or method is passed, these default ones will be used
     */
    private $_DEFAULT_CONTROLLER = 'index';
    private $_DEFAULT_METHOD = 'index';

    /**
     * Folder in which the controllers of the application are stored.
     */
    private $_APPLICATION_CONTROLLERS_FOLDER = 'controllers';

    /**
     * Folder in which the models of the application are stored.
     */
    private $_APPLICATION_MODELS_FOLDER = 'models';

    /************************/
    /** BOOTING PARAMETERS **/
    /************************/

    /**
     * Contains the Url that this class will boot. It is an array that consists of:
     * 0 - Controller.
     * 1 - Method.
     * 2~X - Args
     * @var array
     */
    private $_url;

    /**
     * Contains the Controller to execute.
     * @var Object
     */
    private $_controller;

    /**
     * Contains the name of the method to call in the Controller
     * @var string
     */
    private $_method;

    /**
     * Contains the parameters to pass to the method in the Controller.
     * @var array
     */
    private $_args;

    /**
     * Boots the application.
     */
    public function begin()
    {
        try {
            $this->_setUrl();

            $this->_setController();

            $this->_setMethod();

            $this->_setArgs();
        }
        catch (Exception $e)
        {
            $this->_setRequestToErrorPage($e->getMessage());
        }
        $this->_executeRequest();
    }


    /*****************************/
    /** SYSTEM SETTINGS SETTERS **/
    /** ----------------------- ***********************************************************/
    /**                                                                                  **/
    /** Use this methods very carefully - they might change the whole application logic. **/
    /**                                                                                  **/
    /**************************************************************************************/

    /**
     * Sets the controller to boot in case none is provided.
     * @param string $DEFAULT_CONTROLLER
     */
    public function set_DEFAULT_CONTROLLER($DEFAULT_CONTROLLER)
    {
        $this->_DEFAULT_CONTROLLER = (string) $DEFAULT_CONTROLLER;
    }

    /**
     * Sets the method to boot in case none is provided.
     * @param string $DEFAULT_METHOD
     */
    public function set_DEFAULT_METHOD($DEFAULT_METHOD)
    {
        $this->_DEFAULT_METHOD = (string) $DEFAULT_METHOD;
    }

    /**
     * Sets the error controller of the application.
     * @param string $ERROR_CONTROLLER
     */
    public function set_ERROR_CONTROLLER($ERROR_CONTROLLER)
    {
        $this->_ERROR_CONTROLLER = (string) $ERROR_CONTROLLER;
    }

    /**
     * Sets the Controllers folder of the application.
     * In case this is not defined, Bootstrap will initialize the default application.
     * @param string $APPLICATION_CONTROLLERS_FOLDER
     */
    public function set_APPLICATION_CONTROLLERS_FOLDER($APPLICATION_CONTROLLERS_FOLDER)
    {
        $this->_APPLICATION_CONTROLLERS_FOLDER = (string) $APPLICATION_CONTROLLERS_FOLDER;
    }

    /**
     * Sets the Models folder of the application.
     * In case this is not defined, Bootstrap will initialize the default application.
     * @param string $APPLICATION_MODELS_FOLDER
     */
    public function set_APPLICATION_MODELS_FOLDER($APPLICATION_MODELS_FOLDER)
    {
        $this->_APPLICATION_MODELS_FOLDER = (string) $APPLICATION_MODELS_FOLDER;
    }

    /**
     * Last step of the booting of the application.
     *
     * Notice the following: the arguments property might contain 1 to X parameters, if it is set.
     * The method in the controller needs these parameters in order, not in the array format, as it is in the arguments property. Therefore
     * the function call_user_func_array is helpful here; this function passes the arguments array separating one by one.
     * Example: call_user_func_array (array('error', 'sample'), array('one','two','three'));
     *          In this example method 'sample' in controller 'error' is called with the array of parameters 'one', 'two', and 'three'.
     *          This would be the same than doing the following:
     *          $error = new Error();
     *          $error->sample('one','two','three');
     */
    private function _executeRequest()
    {
        // At this point the property Args might be null, in case of no Args passed. In that case the method is called with no args.
        if (isset($this->_args))
        {
            call_user_func_array(array($this->_controller, $this->_method), $this->_args);
        }
        else
        {
            $this->_controller->{$this->_method}();
        }
    }

    /**
     * First step in the booting of the application.
     * Gets, manipulates and stores the requested URL.
     */
    private function _setUrl()
    {
        if (isset($_GET['url']))
        {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
        }
        else
        {
            $url = $this->_getDefaultUrl();
        }

        $this->_url[self::URL_CONTROLLER] = $url[self::URL_CONTROLLER];

        if (isset($url[self::URL_METHOD]))
        {
            $this->_url[self::URL_METHOD] = $url[self::URL_METHOD];
        }

        if (isset($url[self::URL_ARGUMENTS]))
        {
            $this->_url[self::URL_ARGUMENTS] = array_slice($url, 2);
        }
    }

    /**
     * Loads the controller requested by the URL collected in _getUrl.
     * System Root Path - c:\xampp\htdocs\furgoweb
     * System Controllers Folder by default - controllers
     * Controller requested - Help
     *
     * Example : c:\xampp\htdocs\furgoweb\controllers\Help.php
     *
     * @throws Exception If requested controller does not exist.
     */
    private function _setController()
    {
        $requestedControllerPath = _SYSTEM_ROOT_PATH . $this->_APPLICATION_CONTROLLERS_FOLDER . $this->_url[self::URL_CONTROLLER] . '.php';

        if (file_exists($requestedControllerPath))
        {
            require $requestedControllerPath;
            $this->_controller = new $this->_url[self::URL_CONTROLLER]($this->_APPLICATION_MODELS_FOLDER);
        }
        else
        {
            throw new Exception ('The requested page does not exist.');
        }
    }

    /**
     * Extracts the method requested by the URL collected in _getUrl.
     * @throws Exception If requested method does not exist in the controller.
     */
    private function _setMethod()
    {
        if (isset($this->_url[self::URL_METHOD]))
        {
            $requestedMethod = $this->_url[self::URL_METHOD];
        }
        else
        {
            $requestedMethod = $this->_DEFAULT_METHOD;
        }

        // Verify passed method or default one exists in that controller
        if (!method_exists($this->_controller, $requestedMethod))
        {
            throw new Exception ('The requested resource '. $requestedMethod .' in '. $this->_controller .' does not exist.');
        }

        $this->_method = $requestedMethod;
    }

    /**
     * Extracts the arguments passed by the URL collected in _getUrl.
     * In case none are passed, the property $this->_args will be NULL.
     */
    private function _setArgs()
    {
        if (isset($this->_url[self::URL_ARGUMENTS]))
        {
            $args = $this->_url[self::URL_ARGUMENTS];
        }
        else
        {
            $args = NULL;
        }

        $this->_args = $args;
    }

    /**
     * Delivers the Default Url. Used when none is provided.
     * @return array
     */
    private function _getDefaultUrl()
    {
        return array($this->_DEFAULT_CONTROLLER);
    }

    /**
    * Called when something went wrong on while Bootstrapping the application.
    * @param $msg
    */
    private function _setRequestToErrorPage($msg)
    {
        try {
            $errorControllerPath = _SYSTEM_ROOT_PATH . $this->_APPLICATION_CONTROLLERS_FOLDER . $this->_ERROR_CONTROLLER. '.php';
            require $errorControllerPath;

            $this->_controller = new $this->_ERROR_CONTROLLER($this->_APPLICATION_MODELS_FOLDER);
            $this->_method = $this->_DEFAULT_METHOD;
            $this->_args = array($msg);
        }
        catch (Exception $e)
        {
            exit('Fatal Error in the System while Booting. Please report Batman the following message : ' . $e->getMessage());
        }
    }
}