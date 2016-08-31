<?php

namespace seregazhuk\Favro\Api\Endpoints;

use seregazhuk\Favro\Api\Endpoints\Traits\CrudEndpoint;

class TaskLists extends Endpoint
{

    use CrudEndpoint;

    /**
     * @var string
     */
    protected $endpoint = 'tasklists';
}