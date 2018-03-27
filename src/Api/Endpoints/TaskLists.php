<?php

namespace seregazhuk\Favro\Api\Endpoints;

class TaskLists extends CrudEndpoint
{
    /**
     * {@inheritdoc}
     */
    public function endpoint()
    {
        return 'tasklists';
    }
}
