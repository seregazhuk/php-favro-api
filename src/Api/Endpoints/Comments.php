<?php

namespace seregazhuk\Favro\Api\Endpoints;

use seregazhuk\Favro\Api\Endpoints\Traits\CrudEndpoint;
use seregazhuk\Favro\Api\Endpoints\Traits\BelongsToCard;
use seregazhuk\Favro\Api\Endpoints\Traits\BelongsToOrganization;

class Comments extends Endpoint
{

    use CrudEndpoint, BelongsToOrganization, BelongsToCard;

    /**
     * @var string
     */
    protected $endpoint = 'comments';
}