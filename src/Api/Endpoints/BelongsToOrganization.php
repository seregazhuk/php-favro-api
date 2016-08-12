<?php

namespace seregazhuk\Favro\Api\Endpoints;

trait BelongsToOrganization {

	/**
	 * @var string
	 */
	protected $organizationId;

	/**
	 * @param int $organizationId
	 * @return $this
	 */
	public function setOrganizationId($organizationId)
	{
		$this->organizationId = $organizationId;

		return $this;
	}

	protected function getHeaders()
	{
		return ['organizationId' => $this->organizationId];
	}
}