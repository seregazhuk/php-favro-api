<?php

namespace seregazhuk\Favro\Api\Endpoints;

use ReflectionClass;
use seregazhuk\Favro\Contracts\HttpInterface;
use seregazhuk\Favro\Exceptions\BadEndpointException;

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
	 * @param HttpInterface $http
	 */
    public function __construct(HttpInterface $http)
    {
        $this->http = $http;
    }


	/**
	 * @param string $endpoint
	 * @return Endpoint
	 */
    public function resolveEndpoint($endpoint)
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
	 * @throws BadEndpointException
	 */
    protected function addProvider($endpoint)
    {
        $className = self::ENDPOINTS_NAMESPACE . ucfirst($endpoint);

        if (!class_exists($className)) {
            throw new BadEndpointException("Endpoint $className not found.");
        }

        $this->endpoints[$endpoint] = $this->buildEndpoint($className);
    }


	/**
	 * @param string $className
	 * @return Endpoint|object
	 */
    protected function buildEndpoint($className)
    {
        return (new ReflectionClass($className))
            ->newInstanceArgs([$this->http]);
    }
}