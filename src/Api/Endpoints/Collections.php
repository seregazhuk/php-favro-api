<?php

namespace seregazhuk\Favro\Api\Endpoints;

use seregazhuk\Favro\Api\Endpoints\Traits\CrudEndpoint;

class Collections extends Endpoint
{
    use CrudEndpoint;

    /**
     * @var string
     */
    protected $endpoint = 'collections';
}