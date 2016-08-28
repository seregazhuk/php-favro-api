<?php

namespace seregazhuk\Favro;

use GuzzleHttp\Client;
use seregazhuk\Favro\Api\Api;
use seregazhuk\Favro\Api\Endpoints\EndpointsContainer;

class Favro
{
    /**
     * @param string $login
     * @param string $password
     * @return Api
     */
    public static function create($login, $password)
    {
        $endpointsContainer = new EndpointsContainer(
            self::getHttpInterfaceAdapter($login, $password)
        );
        return new Api($endpointsContainer);
    }

    /**
     * @param string $login
     * @param string $password
     * @return GuzzleHttpClient
     */
    protected static function getHttpInterfaceAdapter($login, $password)
    {
        return new GuzzleHttpClient(
            new Client(['auth' => [$login, $password]])
        );
    }

    private function __construct()
    {
    }

    private function __clone()
    {
    }
}