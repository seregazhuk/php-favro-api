<?php

namespace seregazhuk\Favro\Api\Endpoints;

use seregazhuk\Favro\Api\Endpoints\Traits\CrudEndpoint;
use seregazhuk\Favro\Api\Endpoints\Traits\BelongsToWidget;
use seregazhuk\Favro\Api\Endpoints\Traits\BelongsToOrganization;

class Columns extends Endpoint
{

    use BelongsToOrganization, CrudEndpoint;

    /**
     * @var string
     */
    protected $endpoint = 'columns';
}