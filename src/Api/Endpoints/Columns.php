<?php

namespace seregazhuk\Favro\Api\Endpoints;

use seregazhuk\Favro\Api\Endpoints\Traits\BelongsToOrganization;
use seregazhuk\Favro\Api\Endpoints\Traits\CrudEndpoint;

class Columns extends Endpoint {
	use BelongsToOrganization, CrudEndpoint;

	protected $endpoint = 'columns';

	public function getAllForWidget($widgetCommonId)
	{
		return parent::getAll(['widgetCommonId'=>$widgetCommonId]);
	}
}