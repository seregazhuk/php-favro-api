<?php

namespace seregazhuk\tests;

use GuzzleHttp\Client;
use Mockery;
use seregazhuk\Favro\GuzzleHttpClient;
use seregazhuk\Favro\Api\Endpoints\Endpoint;
use seregazhuk\Favro\Contracts\HttpClient;

class EndpointTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_should_check_if_method_is_allowed_to_call()
    {
        $endpoint = new Endpoint(new GuzzleHttpClient(new Client()));
        $this->assertTrue($endpoint->isMethodAllowed('getById'));

        $this->assertFalse($endpoint->isMethodAllowed('unknownMethod'));
    }

    /** @test */
    public function it_returns_instance_of_http_contract()
    {
        $endpoint = new Endpoint($this->createHttpMock());

        $this->assertInstanceOf(HttpClient::class, $endpoint->getHttp());
    }

    /**
     * @return Mockery\MockInterface|HttpClient
     */
    protected function createHttpMock()
    {
        return Mockery::mock(GuzzleHttpClient::class);
    }

    protected function tearDown()
    {
        Mockery::close();
    }
    
}
