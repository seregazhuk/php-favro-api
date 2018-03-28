<?php

namespace seregazhuk\tests;

use seregazhuk\Favro\Api\Endpoints\Endpoint;

class DummyEndpoint extends Endpoint
{
    /**
     * @return string
     */
    public function endpoint()
    {
        return 'dummy';
    }
}
