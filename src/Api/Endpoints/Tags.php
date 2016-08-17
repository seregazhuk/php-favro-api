<?php

namespace seregazhuk\Favro\Api\Endpoints;

use seregazhuk\Favro\Api\Endpoints\Traits\BelongsToOrganization;
use seregazhuk\Favro\Api\Endpoints\Traits\CrudEndpoint;

class Tags extends Endpoint {

	use CrudEndpoint, BelongsToOrganization;

	/**
	 * @var string
	 */
	protected $endpoint = 'tags';
}