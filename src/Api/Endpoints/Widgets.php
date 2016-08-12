<?php


namespace seregazhuk\Favro\Api\Endpoints;

class Widgets extends Endpoint {

	use BelongsToOrganization;

	protected $endpoint = 'widgets';
}