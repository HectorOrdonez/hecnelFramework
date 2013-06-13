<?php
/**
 * Project: Furgoweb
 * User: Hector Ordonez
 * Date: 11/06/13 12:09
 */

class View
{
    /**
     * Title of the Page.
     * @var string
     */
    protected $title = 'HEC Framework';

    /**
     * List of js files that the page needs to load
     * @var array
     */
    protected $js = array();

    /**
     * List of css files that the page needs to load
     * @var array
     */
    protected $css = array();

    /**
     * Path of the header to be rendered.
     * @var string
     */
    protected $header = 'views/generic/header.php';

    /**
     * Path of the footer to be rendered.
     * @var string
     */
    protected $footer = 'views/generic/footer.php';

    /**
     * View Constructor.
     * Loads the generic CSS and JS libraries. If an extended view class does not need this libraries this
     * construct does not need to be called.
     */
    public function __construct()
    {
        $this->addLibrary('css' , 'public/css/default.css');
        $this->addLibrary('js' , 'public/js/jquery-1.10.1.js');
    }

    /**
     * Adds a CSS or JS library to the appropriate array in the View.
     * The handling of these arrays is normally done in the Header. In case the generic Header is not called, another
     * view has to render them.
     * @param string $type
     * @param string $libraryPath
     */
    public function addLibrary($type, $libraryPath)
    {
        if ($type == 'css') {
            $this->css[] = BASE_URL . $libraryPath;
        } elseif ($type == 'js') {
            $this->js[] = BASE_URL.$libraryPath;
        }
    }

    /**
     * Sets a parameter to the specified key in the view.
     * @param string $key
     * @param mixed $value
     */
    public function setParameter($key, $value)
    {
        $this->$key = $value;
    }

    public function render($name)
    {
        if (strlen($this->header) > 0) {
            require $this->header;
        }
        require 'views/' . $name . '.php';

        if (strlen($this->footer) > 0) {
            require $this->footer;
        }
    }
}