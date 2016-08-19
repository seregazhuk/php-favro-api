<?php

namespace seregazhuk\tests;

use GuzzleHttp\Client;
use seregazhuk\Favro\Adapters\GuzzleHttpAdapter;
use seregazhuk\Favro\Api\Endpoints\Endpoint;
use seregazhuk\Favro\Contracts\HttpInterface;

class EndpointTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_should_check_if_method_is_allowed_to_call()
    {
        $endpoint = new Endpoint(new GuzzleHttpAdapter(new Client()));
        $this->assertTrue($endpoint->isMethodAllowed('getById'));

        $this->assertFalse($endpoint->isMethodAllowed('unknownMethod'));
    }

    public function it_returns_instance_of_http_contract()
    {
        $endpoint = new Endpoint(new GuzzleHttpAdapter(new Client()));

        $this->assertInstanceOf(HttpInterface::class, $endpoint->getHttp());
    }
}
