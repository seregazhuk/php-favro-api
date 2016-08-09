<?php

namespace seregazhuk\Favro\Api\Endpoints;

class Users extends Endpoint
{
    protected $endpoint = 'users';

    /**
     * @param $organizationId
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
     * @param string $userId
     * @return array
     */
    public function getById($userId)
    {
        return $this
            ->http
            ->get(
                $this->makeRequestUrl($userId),
                [],
                ['userId' => $userId]
            );
    }
}