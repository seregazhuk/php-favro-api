<?php

namespace seregazhuk\Favro\Api\Endpoints;

class TaskLists extends CrudEndpoint
{
    /**
     * @return string
     */
    public function endpoint()
    {
        return 'tasklists';
    }
}
