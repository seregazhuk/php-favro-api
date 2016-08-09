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
     * @param string $name
     * @param string $organizationId
     * @param array $shareToUsers
     * @return array
     */
    public function create($name, $organizationId, $shareToUsers = [])
    {
        return $this
            ->http
            ->post(
                $this->makeRequestUrl(),
                [
                    'name'         => $name,
                    'shareToUsers' => $shareToUsers,
                ],
                ['organizationId' => $organizationId]
            );
    }
}