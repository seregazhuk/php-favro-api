<?php

namespace seregazhuk\Favro\Api\Endpoints;

class BelongsToOrganizationEndpoint extends Endpoint {
	/**
	 * @param string $id
	 * @param string $organizationId
	 * @return array
	 */
	public function getById($id, $organizationId)
	{
		return $this
			->http
			->get(
				$this->makeRequestUrl($id),
				[],
				['organizationId' => $organizationId]
			);
	}

	/**
	 * @param string $organizationId
	 * @param array $params
	 * @return array
	 */
	public function getAll($organizationId, array $params = [])
	{
		return $this
			->http
			->get(
				$this->makeRequestUrl(),
				$params,
				['organizationId' => $organizationId]
			);
	}

	/**
	 * @param array $attributes
	 * @param string $organizationId
	 * @return array
	 */
	public function create(array $attributes, $organizationId)
	{
		return $this
			->http
			->post(
				$this->makeRequestUrl(),
				$attributes,
				['organizationId' => $organizationId]
			);
	}

	/**
	 * @param string $id
	 * @param string $organizationId
	 * @param array $attributes
	 * @return mixed
	 */
	public function update($id, $organizationId, array $attributes)
	{
		return $this
			->http
			->put(
				$this->makeRequestUrl($id),
				$attributes,
				['organizationId' => $organizationId]
			);
	}

	/**
	 * @param string $id
	 * @param string $organizationId
	 * @return mixed
	 */
	public function delete($id, $organizationId)
	{
		return $this
			->http
			->delete(
				$this->makeRequestUrl($id),
				['organizationId' => $organizationId]
			);
	}
}