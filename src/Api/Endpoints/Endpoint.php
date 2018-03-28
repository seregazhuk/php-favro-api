<?php

namespace seregazhuk\Favro\Api\Endpoints;

use seregazhuk\Favro\Contracts\HttpClient;

abstract class Endpoint
{
    /**
     * @var array
     */
    protected $rateLimitInfo;

    /**
     * @var array
     */
    protected $headers = [];

    /**
     * @var HttpClient
     */
    protected $http;

    /**
     * @var string
     */
    protected $organizationId;

    /**
     * @param HttpClient $http
     */
    public function __construct(HttpClient $http)
    {
        $this->http = $http;
    }

    /**
     * @param string $verb
     * @return string
     */
    public function makeRequestUrl($verb = '')
    {
        return "https://favro.com/api/v1/{$this->endpoint()}/$verb";
    }

    /**
     * @param array $params
     * @return array
     */
    public function getAll(array $params = [])
    {
        return $this
            ->http
            ->get(
                $this->makeRequestUrl(),
                $params,
                $this->headers()
            );
    }

    /**
     * @param string $id
     * @return array
     */
    public function getById($id)
    {
        return $this
            ->http
            ->get(
                $this->makeRequestUrl($id),
                [],
                $this->headers()
            );
    }

    /**
     * @return array
     */
    protected function headers()
    {
        return array_merge(
            ['organizationId' => $this->organizationId],
            $this->headers
        );
    }

    /**
     * @param string $organizationId
     * @return $this
     */
    public function withOrganization($organizationId)
    {
        $this->organizationId = $organizationId;

        return $this;
    }

    /**
     * @return string
     */
    abstract public function endpoint();
}
