<?php

namespace seregazhuk\Favro\Api;

use seregazhuk\Favro\Api\Endpoints\Cards;
use seregazhuk\Favro\Api\Endpoints\Comments;
use seregazhuk\Favro\Api\Endpoints\TaskLists;
use seregazhuk\Favro\Api\Endpoints\Tasks;
use seregazhuk\Favro\Api\Endpoints\Users;
use seregazhuk\Favro\Api\Endpoints\Columns;
use seregazhuk\Favro\Api\Endpoints\Widgets;
use seregazhuk\Favro\Api\Endpoints\Endpoint;
use seregazhuk\Favro\Api\Endpoints\Collections;
use seregazhuk\Favro\Api\Endpoints\Organizations;
use seregazhuk\Favro\Contracts\HttpClient;
use seregazhuk\Favro\Exceptions\WrongEndpoint;
use seregazhuk\Favro\Exceptions\WrongOrganizationName;

/**
 * Class Api
 *
 * @property Organizations $organizations
 * @property Users $users
 * @property Collections $collections
 * @property Widgets $widgets
 * @property Columns $columns
 * @property Cards $cards
 * @property Tasks $tasks
 * @property TaskLists $tasklists
 * @property Comments $comments
 */
class Api
{
    /**
     * @var string
     */
    private $organizationId;

    /**
     * @var HttpClient
     */
    private $http;

    /**
     * @var Endpoint[]
     */
    private $endpoints;

    public function __construct(HttpClient $http, Endpoint ...$endpoints)
    {
        $this->http = $http;
        foreach ($endpoints as $endpoint) {
            $this->endpoints[$endpoint->endpoint()] = $endpoint;
        }
    }

    /**
     * Magic method to access different endpoints.
     *
     * @param string $alias
     *
     * @return Endpoint
     * @throws WrongEndpoint
     */
    public function __get($alias)
    {
        return $this
            ->resolveEndpoint($alias)
            ->withOrganization($this->organizationId);
    }

    /**
     * @param string $organizationName
     * @return $this
     * @throws WrongOrganizationName
     */
    public function useOrganization($organizationName)
    {
        if ($organization = $this->getOrganizationByName($organizationName)) {
            $this->organizationId = $organization['organizationId'];
        }

        return $this;
    }

    /**
     * @param string $organizationName
     * @return array|bool
     * @throws WrongOrganizationName
     */
    private function getOrganizationByName($organizationName)
    {
        $organizations = $this->organizations->getAll();
        foreach ($organizations['entities'] as $entity) {
            if ($entity['name'] === $organizationName) {
                return $entity;
            }
        }

        throw new WrongOrganizationName("Organization $organizationName not found!");
    }

    /**
     * @param string $alias
     * @return Endpoint
     * @throws WrongEndpoint
     */
    private function resolveEndpoint($alias)
    {
        $alias = strtolower($alias);

        if (isset($this->endpoints[$alias])) {
            return $this->endpoints[$alias];
        }

        throw new WrongEndpoint("There is no endpoint called $alias.");
    }

    /**
     * @return array
     */
    public function getRateInfo()
    {
        $responseHeaders = $this->http->getResponseHeaders();

        return [
            'reset'     => $responseHeaders['X-RateLimit-Reset'][0],
            'limit'     => $responseHeaders['X-RateLimit-Limit'][0],
            'remaining' => $responseHeaders['X-RateLimit-Remaining'][0],
        ];
    }
}
