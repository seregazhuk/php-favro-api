<?php

namespace seregazhuk\Favro\Api\Endpoints;

class Collections extends Endpoint
{
    protected $endpoint = 'collections';

    /**
     * @param string $organizationId
     * @return array
     */
    public function getAll($organizationId)
    {
        return $this
            ->http
            ->get(
                $this->makeRequestUrl(),
                [],
                ['organizationId' => $organizationId]
            );
    }

    /**
     * @param string $collectionId
     * @param string $organizationId
     * @return array
     */
    public function getById($collectionId, $organizationId)
    {
        return $this
            ->http
            ->get(
                $this->makeRequestUrl($collectionId),
                [],
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
	 * @param string $collectionId
	 * @param string $organizationId
	 * @param array $attributes
	 * @return mixed
	 */
	public function update($collectionId, $organizationId, array $attributes)
	{
		return $this
			->http
			->put(
				$this->makeRequestUrl($collectionId),
				$attributes,
				['organizationId' => $organizationId]
			);
    }

    /**
     * @param string $collectionId
     * @param string $organizationId
     * @return mixed
     */
    public function delete($collectionId, $organizationId)
    {
        return $this
            ->http
            ->delete(
                $this->makeRequestUrl($collectionId),
                ['organizationId' => $organizationId]
        );
    }
}