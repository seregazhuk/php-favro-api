<?php

namespace seregazhuk\Favro\Api\Endpoints;

use ReflectionClass;
use seregazhuk\Favro\Contracts\HttpClient;
use seregazhuk\Favro\Exceptions\WrongEndpoint;

class EndpointsContainer
{
    const ENDPOINTS_NAMESPACE = 'seregazhuk\\Favro\\Api\\Endpoints\\';

    /*
    * @var HttpInterface
    */
    protected $http;

    /*
     * @var array
     */
    protected $endpoints = [];

    /**
     * @param HttpClient $http
     */
    public function __construct(HttpClient $http)
    {
        $this->http = $http;
    }

    /**
     * @param string $endpoint
     * @return Endpoint
     */
    public function resolve($endpoint)
    {
        $endpoint = strtolower($endpoint);

        // Check if an instance has already been initiated
        if (!isset($this->endpoints[$endpoint])) {
            $this->addProvider($endpoint);
        }

        return $this->endpoints[$endpoint];
    }

    /**
     * @param $endpoint
     * @throws WrongEndpoint
     */
    protected function addProvider($endpoint)
    {
        $className = self::ENDPOINTS_NAMESPACE . ucfirst($endpoint);

        if (!class_exists($className)) {
            throw new WrongEndpoint("Endpoint $className not found.");
        }

        $this->endpoints[$endpoint] = $this->buildEndpoint($className);
    }

    /**
     * @param string $className
     * @return Endpoint|object
     */
    protected function buildEndpoint($className)
    {
        return (new ReflectionClass($className))->newInstanceArgs([$this->http]);
    }
}