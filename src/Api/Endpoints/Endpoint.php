<?php

namespace seregazhuk\Favro\Api\Endpoints;

use seregazhuk\Favro\Contracts\HttpInterface;

class Endpoint
{
	/**
	 * @var array
	 */
	protected $allowedMethods = [
		'getById',
	    'getAll',
	    'create',
	    'update',
	    'delete'
	];

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
    public function makeRequestUrl($verb = '')
    {
        return "https://favro.com/api/v1/{$this->endpoint}/$verb";
    }

	/**
	 * @param string $method
	 * @return bool
	 */
	public function isMethodAllowed($method)
	{
		return in_array($method, $this->allowedMethods);
    }

	/**
	 * @return HttpInterface
	 */
	public function getHttp()
	{
		return $this->http;
    }

}