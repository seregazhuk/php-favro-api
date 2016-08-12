<?php

namespace seregazhuk\Favro\Api\Endpoints;

class Users extends Endpoint
{
	use BelongsToOrganization;

    protected $endpoint = 'users';
}