<?php

namespace seregazhuk\Favro\Api\Endpoints;

trait BelongsToOrganization {

	/**
	 * @var string
	 */
	protected $organizationId;

	/**
	 * @param string $id
	 * @return array
	 */
	public function getById($id)
	{
		return $this
			->getHttp()
			->get(
				$this->makeRequestUrl($id),
				[],
				['organizationId' => $this->organizationId]
			);
	}

	/**
	 * @param array $params
	 * @return array
	 */
	public function getAll(array $params = [])
	{
		return $this
			->getHttp()
			->get(
				$this->makeRequestUrl(),
				$params,
				['organizationId' => $this->organizationId]
			);
	}

	/**
	 * @param array $attributes
	 * @return array
	 */
	public function create(array $attributes)
	{
		return $this
			->getHttp()
			->post(
				$this->makeRequestUrl(),
				$attributes,
				['organizationId' => $this->organizationId]
			);
	}

	/**
	 * @param string $id
	 * @param array $attributes
	 * @return mixed
	 */
	public function update($id, array $attributes)
	{
		return $this
			->getHttp()
			->put(
				$this->makeRequestUrl($id),
				$attributes,
				['organizationId' => $this->organizationId]
			);
	}

	/**
	 * @param string $id
	 * @return mixed
	 */
	public function delete($id)
	{
		return $this
			->getHttp()
			->delete(
				$this->makeRequestUrl($id),
				['organizationId' => $this->organizationId]
			);
	}

	/**
	 * @param int $organizationId
	 * @return $this
	 */
	public function setOrganization($organizationId)
	{
		$this->organizationId = $organizationId;

		return $this;
	}
}