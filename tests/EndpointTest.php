<?php

namespace seregazhuk\tests;

use Mockery;
use GuzzleHttp\Client;
use seregazhuk\Favro\GuzzleHttpClient;
use seregazhuk\Favro\Contracts\HttpClient;
use seregazhuk\Favro\Api\Endpoints\Endpoint;

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
        $endpoint = new Endpoint($this->createHttpClient());

        $this->assertInstanceOf(HttpClient::class, $endpoint->getHttp());
    }

    /** @test */
    public function it_should_proxy_call_to_http_client_when_receiving_all_items()
    {
        $httpClient = $this->createHttpClient();
        $endpoint = new Endpoint($httpClient);
        $params = ['page' => 1,];

        $httpClient
            ->shouldReceive('get')
            ->withAnyArgs([
                $endpoint->makeRequestUrl(),
                [$params],
                $endpoint->getHeaders()
            ]);
        $endpoint->getAll($params);
    }

    /** @test */
    public function it_should_proxy_call_to_http_client_when_receiving_item_by_id()
    {
        $httpClient = $this->createHttpClient();
        $endpoint = new Endpoint($httpClient);

        $httpClient
            ->shouldReceive('get')
            ->withAnyArgs([
                $endpoint->makeRequestUrl(1),
                [],
                $endpoint->getHeaders()
            ]);
        $endpoint->getById(1);
    }

    /** @test */
    public function it_should_store_organization_id()
    {
        $organizationId = '1234567890';
        $endpoint = new Endpoint($this->createHttpClient());

        $endpoint->setOrganizationId($organizationId);

        $reflectedProperty = (new \ReflectionClass($endpoint))->getProperty('organizationId');
        $reflectedProperty->setAccessible(true);

        $this->assertEquals($organizationId, $reflectedProperty->getValue($endpoint));
    }

    /**
     * @return Mockery\MockInterface|HttpClient
     */
    protected function createHttpClient()
    {
        return Mockery::mock(GuzzleHttpClient::class);
    }

    protected function tearDown()
    {
        Mockery::close();
    }
    
}
