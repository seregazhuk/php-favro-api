<?php

namespace seregazhuk\Favro\Api\Endpoints;

class Tasks extends CrudEndpoint
{
    /**
     * @return string
     */
    public function endpoint()
    {
        return 'tasks';
    }
}
