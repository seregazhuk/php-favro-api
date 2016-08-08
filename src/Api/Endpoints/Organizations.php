<?php

namespace seregazhuk\Favro\Api\Endpoints;

class Organizations extends Endpoint
{
    protected $endpoint = 'organizations';

    public function getAll()
    {
        return $this
            ->http
            ->get($this->makeRequestUrl(), []);
    }

    public function getById($organizationId)
    {
        return $this->http->get(
            $this->makeRequestUrl(':id'),
            [],
            ['organizationId' => $organizationId]);
    }
}