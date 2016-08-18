<?php

namespace seregazhuk\Favro\Api\Endpoints;

use seregazhuk\Favro\Api\Endpoints\Traits\CrudEndpoint;
use seregazhuk\Favro\Api\Endpoints\Traits\BelongsToOrganization;

class Collections extends Endpoint
{
    use BelongsToOrganization, CrudEndpoint;

    /**
     * @var string
     */
    protected $endpoint = 'collections';
}