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
    protected $_title = 'HEC Framework';

    /**
     * List of js files that the page needs to load
     * @var array
     */
    protected $_js = array();

    /**
     * List of css files that the page needs to load
     * @var array
     */
    protected $_css = array();

    /**
     * Path of the header to be rendered.
     * @var string
     */
    protected $_header = 'views/generic/header.php';

    /**
     * Path of the footer to be rendered.
     * @var string
     */
    protected $_footer = 'views/generic/footer.php';

    /**
     * Array of view chunks to be rendered. The set order defines the render order.
     * @var array
     */
    protected $_chunks = array();

    /**
     * Array of Meta tags to be added in the Header. Each value of the array contains an array of data.
     * Example:
     * $_meta = array (
     *      'name' => array (
     *          'name' => 'MyName',
     *          'content' => 'MyNameContent'>
     *      'keywords' => array (
     *          'name' => 'keywords',
     *          'content' => 'hoygan, reconchuda, lareputamadre'
     *      'http->equiv => 'Content-Script-Type',
     *      'content' => 'text/javascript'
     * );
     *
     * Notice that the index of each position of an array is a custom name that defines that type of Meta tag.
     * The controller defines a default meta construction, but if a child needs a different Meta then it needs to
     * add a new meta for that index.
     * @var array
     */
    protected $_meta = array();

    /**
     * View Constructor.
     * Loads the generic CSS and JS libraries. If an extended view class does not need this libraries this
     * construct does not need to be called.
     */
    public function __construct()
    {
    }

    /**
     * Adds a CSS or JS library to the appropriate array in the View.
     * The handling of these arrays is normally done in the Header. In case the generic Header is not called, another
     * view has to render them.
     * @param string $type
     * @param string $libraryPath
     * @todo Add possibility of external libraries.
     */
    public function addLibrary($type, $libraryPath)
    {
        if ($type == 'css') {
            $this->_css[] = _SYSTEM_BASE_URL . $libraryPath;
        } elseif ($type == 'js') {
            $this->_js[] = _SYSTEM_BASE_URL.$libraryPath;
        }
    }

    /**
     * Adds a meta tag to the specified index.
     * If a Meta tag already exists with that index, it is overridden.
     * @param string $index
     * @param array $meta
     */
    public function setMeta($index, $meta)
    {
        $this->_meta[$index] = $meta;
    }

    /**
     * Sets the title of the page.
     * @param string $title
     */
    public function setTitle ($title)
    {
        $this->_title = $title;
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

    /**
     * Sets the Header chunk.
     * @param string $chunk
     */
    public function setHeaderChunk($chunk)
    {
        $this->_header = $chunk;
    }

    /**
     * Sets the Footer chunk.
     * @param string $chunk
     */
    public function setFooterChunk($chunk)
    {
        $this->_footer = (string) $chunk;
    }

    /**
     * Adds a view chunk. As an optional parameter, position can be sent. In that
     * case the view chunk is injected in that position.
     * @param string $chunk
     * @param int $pos
     */
    public function addChunk($chunk, $pos = NULL)
    {
        if (!isset($pos))
        {
            $this->_chunks[] = $chunk;
        }
        else
        {
            $prevChunks = array_slice($this->_chunks, 0, $pos);
            $postChunks = array_slice($this->_chunks, $pos);
            $prevChunks[] = $chunk;
            $this->_chunks= array_merge($prevChunks, $postChunks);
        }
    }

    /**
     * Returns the Title.
     * @return string
     */
    private function _getTitle()
    {
        return $this->_title;
    }

    /**
     * Returns the array of Css libraries.
     * @return array
     */
    private function _getCss()
    {
        return $this->_css;
    }

    /**
     * Returns the array of Js libraries.
     * @return array
     */
    private function _getJs()
    {
        return $this->_js;
    }

    /**
     * Returns the array of Meta tags.
     * @return array
     */
    private function _getMeta()
    {
        return $this->_meta;
    }

    /**
     * Renders the chunks of the View.
     * @todo Improve header and footer check. Maybe check to Null.
     */
    public function render()
    {
        if (strlen($this->_header) > 0) {
            require $this->_header;
        }

        foreach ($this->_chunks as $chunk)
        {
            require 'views/' . $chunk . '.php';
        }

        if (strlen($this->_footer) > 0) {
            require $this->_footer;
        }
    }
}