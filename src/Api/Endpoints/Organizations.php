<?php

namespace seregazhuk\Favro\Api\Endpoints;

use seregazhuk\Favro\Api\Endpoints\Traits\CrudEndpoint;

class Organizations extends Endpoint
{
	use CrudEndpoint;

    protected $endpoint = 'organizations';

	/**
	 * @param string $id
	 * @return array
	 */
	public function getById($id)
	{
		$this->headers['organizationId'] = $id;

		return parent::getById($id);
	}
}