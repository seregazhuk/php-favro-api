<?php

namespace seregazhuk\Favro\Api\Endpoints;

class Comments extends CrudEndpoint
{
    /**
     * @return string
     */
    public function endpoint()
    {
        return 'comments';
    }
}
