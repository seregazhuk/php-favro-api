<?php

namespace seregazhuk\Favro;

use GuzzleHttp\Client;
use seregazhuk\Favro\Api\Api;
use seregazhuk\Favro\Api\Endpoints\Cards;
use seregazhuk\Favro\Api\Endpoints\Collections;
use seregazhuk\Favro\Api\Endpoints\Columns;
use seregazhuk\Favro\Api\Endpoints\Comments;
use seregazhuk\Favro\Api\Endpoints\Organizations;
use seregazhuk\Favro\Api\Endpoints\Tags;
use seregazhuk\Favro\Api\Endpoints\TaskLists;
use seregazhuk\Favro\Api\Endpoints\Tasks;
use seregazhuk\Favro\Api\Endpoints\Users;
use seregazhuk\Favro\Api\Endpoints\Widgets;

class Favro
{
    /**
     * @param string $login
     * @param string $password
     * @return Api
     */
    public static function create($login, $password)
    {
        $httpClient = new GuzzleHttpClient(
            new Client(['auth' => [$login, $password]])
        );

        return new Api(
            $httpClient,
            new Cards($httpClient),
            new Collections($httpClient),
            new Columns($httpClient),
            new Comments($httpClient),
            new Organizations($httpClient),
            new Tags($httpClient),
            new TaskLists($httpClient),
            new Tasks($httpClient),
            new Users($httpClient),
            new Widgets($httpClient)
        );
    }

    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }

    /**
     * @codeCoverageIgnore
     */
    private function __clone()
    {
    }
}
