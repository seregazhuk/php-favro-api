<?php

namespace seregazhuk\Favro\Api\Endpoints;

use seregazhuk\Favro\Api\Endpoints\Traits\CrudEndpoint;
use seregazhuk\Favro\Api\Endpoints\Traits\BelongsToCard;
use seregazhuk\Favro\Api\Endpoints\Traits\BelongsToOrganization;

class Tasks extends Endpoint {

	use BelongsToOrganization, BelongsToCard, CrudEndpoint;

	/**
	 * @var string
	 */
	protected $endpoint = 'tasks';
}