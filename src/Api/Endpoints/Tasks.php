<?php

namespace seregazhuk\Favro\Api\Endpoints;

use seregazhuk\Favro\Api\Endpoints\Traits\CrudEndpoint;

class Tasks extends Endpoint
{

    use CrudEndpoint;

    /**
     * @var string
     */
    protected $endpoint = 'tasks';
}