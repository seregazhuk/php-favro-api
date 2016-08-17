<?php

namespace seregazhuk\Favro\Api\Endpoints\Traits;

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

	/**
	 * @return array
	 */
	protected function getHeaders()
	{
		return ['organizationId' => $this->organizationId];
	}
}