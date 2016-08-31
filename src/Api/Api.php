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
use seregazhuk\Favro\Api\Endpoints\EndpointsContainer;
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
     * @var EndpointsContainer
     */
    protected $endpointsContainer;

    /**
     * @var string
     */
    protected $organizationId;

    public function __construct(EndpointsContainer $endpointsContainer)
    {
        $this->endpointsContainer = $endpointsContainer;
    }

    /**
     * Magic method to access different endpoints.
     *
     * @param string $endpoint
     *
     * @return Endpoint
     */
    public function __get($endpoint)
    {
        $endpoint = $this->endpointsContainer->resolve($endpoint);

        if (method_exists($endpoint, 'setOrganizationId')) {
            $endpoint->setOrganizationId($this->organizationId);
        }

        return $endpoint;
    }

    /**
     * @param $organizationName
     * @return $this
     */
    public function setOrganization($organizationName)
    {
        if($organization = $this->getOrganizationByName($organizationName)) {
            $this->setOrganizationId($organization['organizationId']);
        }

        return $this;
    }

    /**
     * @param int $organizationId
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
    public function getOrganizationId()
    {
        return $this->organizationId;
    }

    /**
     * @param $organization
     * @return array|bool
     * @throws WrongOrganizationName
     */
    protected function getOrganizationByName($organization)
    {
        $organizations = $this->organizations->getAll();
        foreach ($organizations['entities'] as $entity) {
            if ($entity['name'] == $organization) {
                return $entity;
            }
        }

        throw new WrongOrganizationName("Organization $organization not found!");
    }
}