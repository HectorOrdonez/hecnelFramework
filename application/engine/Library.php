<?php
/**
 * Project: Hecnel Framework
 * User: Hector Ordonez
 * Description:
 * Library class of the application engine.
 * Date: 11/07/13 16:00
 */

namespace application\engine;

use engine\Library as engineLibrary;

class Library extends engineLibrary
{
    public function __construct(Model $model = NULL)
    {
        parent::__construct($model);
    }
}