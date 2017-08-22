<?php

namespace seregazhuk\tests;

use GuzzleHttp\Client;
use Mockery;
use PHPUnit\Framework\TestCase;
use seregazhuk\Favro\Api\Endpoints\EndpointsContainer;
use seregazhuk\Favro\Api\Endpoints\Users;
use seregazhuk\Favro\Contracts\HttpClient;
use seregazhuk\Favro\Exceptions\WrongEndpoint;
use seregazhuk\Favro\GuzzleHttpClient;

class EndpointsContainerTest extends TestCase
{
    /** @test */
    public function it_resolves_an_instance_of_endpoint()
    {
        $container = $this->createContainer();
        $this->assertInstanceOf(Users::class, $container->resolve('users'));
    }

    /** @test */
    public function it_throws_exception_when_resolving_non_existing_endpoint()
    {
        $this->setExpectedException(WrongEndpoint::class);

        $this->createContainer()->resolve('unknown');
    }

    /** @test */
    public function it_parses_rate_limit_headers_from_http_client()
    {
        $httpClient = $this->createHttpClient();
        $httpClient
            ->shouldReceive('getResponseHeaders')
            ->andReturn(
                [
                    'X-RateLimit-Reset'     => [1],
                    'X-RateLimit-Limit'     => [2],
                    'X-RateLimit-Remaining' => [3],
                ]
            );

        $container = $this->createContainer($httpClient);
        $this->assertEquals(
            [
                'reset'     => 1,
                'limit'     => 2,
                'remaining' => 3,
            ], $container->getRateInfo()
        );
    }

    /**
     * @param HttpClient|null $httpClient
     * @return EndpointsContainer
     */
    protected function createContainer($httpClient = null)
    {
        if (!$httpClient) {
            $httpClient = new GuzzleHttpClient(new Client());
        }

        return new EndpointsContainer($httpClient);
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
