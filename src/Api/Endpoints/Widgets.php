<?php


namespace seregazhuk\Favro\Api\Endpoints;

class Widgets extends Endpoint {

	use BelongsToOrganization, CrudEndpoint;

	protected $endpoint = 'widgets';
}