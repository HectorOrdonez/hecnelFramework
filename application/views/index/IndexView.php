<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Date: 12/06/13 12:28
 */

namespace application\views;

use application\engine\View;

class IndexView extends View
{
    public function __construct()
    {
        parent::__construct();
        $this->_headerLayout = 'application/views/layouts/generalLayoutTop';
        $this->_footerLayout = 'application/views/layouts/generalLayoutBottom';
    }
}