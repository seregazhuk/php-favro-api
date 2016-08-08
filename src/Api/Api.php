<?php

namespace seregazhuk\Favro\Api;

use seregazhuk\Favro\Api\Endpoints\Endpoint;
use seregazhuk\Favro\Api\Endpoints\EndpointsContainer;
use seregazhuk\Favro\Api\Endpoints\Organizations;

/**
 * Class Api
 *
 * @property Organizations $organizations
 */
class Api
{
    /**
     * @var EndpointsContainer
     */
    protected $endpointsContainer;


    public function __construct(EndpointsContainer $endpointsContainer)
    {
        $this->endpointsContainer = $endpointsContainer;
    }

    /**
     * Magic method to access different providers.
     *
     * @param string $endpoint
     *
     * @return Endpoint
     */
    public function __get($endpoint)
    {
        return $this->endpointsContainer->resolveEndpoint($endpoint);
    }
}