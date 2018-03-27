<?php

namespace seregazhuk\Favro\Api\Endpoints;

class Comments extends CrudEndpoint
{
    /**
     * {@inheritdoc}
     */
    public function endpoint()
    {
        return 'comments';
    }
}
