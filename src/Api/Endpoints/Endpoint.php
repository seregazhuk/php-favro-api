<?php

namespace seregazhuk\Favro\Api\Endpoints;

use seregazhuk\Favro\Contracts\HttpInterface;

class Endpoint
{
    /**
     * @var string
     */
    protected $endpoint;

    /**
     * @var HttpInterface
     */
    protected $http;

	/**
	 * @param HttpInterface $http
	 */
    public function __construct(HttpInterface $http)
    {
        $this->http = $http;
    }

    /**
     * @param string $verb
     * @return string
     */
    protected function makeRequestUrl($verb = '')
    {
        return "https://favro.com/api/v1/{$this->endpoint}/$verb";
    }

}