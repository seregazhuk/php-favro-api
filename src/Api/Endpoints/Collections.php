<?php

namespace seregazhuk\Favro\Api\Endpoints;

class Collections extends Endpoint
{
	use BelongsToOrganization, CrudEndpoint;

    protected $endpoint = 'collections';
}