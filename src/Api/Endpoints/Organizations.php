<?php

namespace seregazhuk\Favro\Api\Endpoints;

class Organizations extends Endpoint
{
    protected $endpoint = 'organizations';

	/**
	 * @return array
	 */
    public function getAll()
    {
        return $this
            ->http
            ->get($this->makeRequestUrl(), []);
    }

    /**
     * @param int $organizationId
     * @return array
     */
    public function getById($organizationId)
    {
        return $this->http->get(
            $this->makeRequestUrl(':id'),
            [],
            ['organizationId' => $organizationId]);
    }

    /**
     * @param string $name
     * @param array $shareToUsers
     * @return array
     */
    public function create($name, array $shareToUsers = [])
    {
        return $this->http->post(
            $this->makeRequestUrl(),
            [
                'name'         => $name,
                'shareToUsers' => $shareToUsers,
            ]
        );
    }

    /**
     * @param string $organizationId
     * @param string $name
     * @param array $members
     * @param array $shareToUsers
     * @return array
     */
    public function update($organizationId, $name, $members = [], $shareToUsers = [])
    {
        return $this
            ->http
            ->put(
                $this->makeRequestUrl($organizationId),
                [
                    'name'         => $name,
                    'members'      => $members,
                    'shareToUsers' => $shareToUsers,
                ],
                ['organizationId' => $organizationId]
            );
    }
}