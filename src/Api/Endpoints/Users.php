<?php

namespace seregazhuk\Favro\Api\Endpoints;

use seregazhuk\Favro\Api\Endpoints\Traits\BelongsToOrganization;

class Users extends Endpoint
{
    use BelongsToOrganization;

    /**
     * @var string
     */
    protected $endpoint = 'users';
}