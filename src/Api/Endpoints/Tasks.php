<?php

namespace seregazhuk\Favro\Api\Endpoints;

class Tasks extends CrudEndpoint
{
    /**
     * {@inheritdoc}
     */
    public function endpoint()
    {
        return 'tasks';
    }
}
