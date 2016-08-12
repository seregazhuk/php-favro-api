<?php

namespace seregazhuk\Favro\Api\Endpoints;

class Collections extends Endpoint
{
	use BelongsToOrganization;

    protected $endpoint = 'collections';
}