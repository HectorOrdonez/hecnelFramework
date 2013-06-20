<?php
/**
 * Project: Furgoweb
 * User: Hector Ordonez
 * Date: 11/06/13 11:53
 */

class Error extends Controller
{
    /**
     * Error constructor.
     */
    public function __construct($model)
    {
        parent::__construct($model);
    }

    /** General Error Page */
    public function index($error)
    {
        $this->_view->setParameter('msg', $error);

        $this->_view->render('error/index');
    }

    /**
     * Error #401 - Authentication Failed.
     */
    public function authFailed()
    {
        $this->_view->setParameter('msg', 'Authentication Failed');

        $this->_view->render('error/index');
    }

    /**
     * Error #403 - Access Forbidden to this page.
     */
    public function accessForbidden()
    {
        $this->_view->setParameter('msg', 'Access Forbidden to this resource.');

        $this->_view->render('error/index');
    }

    /**
     * Error #500 - Internal Server Error.
     */
    public function internalServerError()
    {
        $this->_view->setParameter('msg', 'Internal Server Error');

        $this->_view->render('error/index');
    }

    /**
     * Error #404 - Resource not found.
     */
    public function resourceNotFound()
    {
        $this->_view->setParameter('msg', 'Requested resource not found.');

        $this->_view->render('error/index');
    }
}
