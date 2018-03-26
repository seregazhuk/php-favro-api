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
     * @return HttpClient
     */
    public function getHttp()
    {
        return $this->http;
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
                $this->getHeaders()
            );
    }

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
                $this->getHeaders()
            );
    }

    /**
     * @return array
     */
    public function getHeaders()
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
    public function setOrganizationId($organizationId)
    {
        $this->organizationId = $organizationId;

        return $this;
    }

    /**
     * @return string
     */
    abstract public function endpoint();
}
