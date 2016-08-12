<?php


namespace seregazhuk\Favro\Api\Endpoints\Traits;

trait CrudEndpoint {

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
}