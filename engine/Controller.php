<?php
/**
 * Project: Furgoweb
 * User: Hector Ordonez
 * Date: 11/06/13 11:59
 *
 * @todo - View and Controller libraries should allow an application to use them. The application should not depend on them to run any logic. I must find a way to avoid the general css, js and meta definitions in these libraries. I think that an interesting approach might to have an "engine" folder for the Framework libraries and another "engine" folder for the Application libraries. Then the Application controllers, libraries, views and models will extend the Application Engine libraries, which would extend the Framework Engine libraries. Need to ponder this.
 */

namespace engine;

use engine\Session as Session;

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

    /*************************/
    /* Controller Settings  **/
    /*************************/


    /**
     * True by default, autoRender tells the Controller is the View must be rendered once the logic is finished.
     * @param boolean $modelsFolder
     */
    protected $_autoRender = TRUE;

    /**
     * Initializes the User Session.
     * Initializes the View and the Model.
     *
     * @param Model $model in which this Controller can search for the Model
     */
    public function __construct(Model $model = NULL)
    {
        Session::init();
        $this->_setView();
        $this->_setModel($model);
    }

    private function _setView()
    {
        $this->_view = new View();

        $this->_view->addLibrary('css' , 'public/css/default.css');

        $this->_view->addLibrary('js' , 'public/js/jquery-1.10.1.js');

        $this->_view->setMeta('description', array(
            'name' => 'description',
            'content' => 'This is a sample page for my Framework'
        ));

        $this->_view->setMeta('author', array(
            'name' => 'author',
            'content' => 'Hector Ordonez'
        ));

        $this->_view->setMeta('keywords', array(
            'name' => 'keywords',
            'content' => 'Framework, PHP, JavaScript, OOP, MVC'
        ));

        $this->_view->setParameter('userLogin', Session::get('isUserLoggedIn'));
        $this->_view->setParameter('userRole', Session::get('userRole'));
    }
    /**
     * Auto-loading of the model method.
     * Checks if there is a model related to this controller and, if so, instantiates it.
     *
     * @param Model $model in which this Controller can search for the Model
     */
    private function _setModel(Model $model = NULL)
    {
        if (!is_null($model)) {
            $this->_model = $model;
        }
    }

    /**
     * Requested by the Bootstrap, the Render method cannot be extended by Controller children.
     * Verifies if the autoRender is enabled and, if so, requested the rendering of the view.
     */
    final public function render()
    {
        if ($this->_autoRender === TRUE)
        {
            $this->_view->render();
        }
    }

    public function setAutoRender($option)
    {
        $this->_autoRender = (boolean) $option;
    }


}