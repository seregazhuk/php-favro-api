<?php

namespace seregazhuk\Favro\Api\Endpoints;

use seregazhuk\Favro\Api\Endpoints\Traits\CrudEndpoint;
use seregazhuk\Favro\Api\Endpoints\Traits\BelongsToWidget;
use seregazhuk\Favro\Api\Endpoints\Traits\BelongsToOrganization;

class Cards extends Endpoint {
	use BelongsToOrganization, BelongsToWidget, CrudEndpoint;

	protected $endpoint = 'cards';
}