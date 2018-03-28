<?php

namespace seregazhuk\tests;

use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use seregazhuk\Favro\Contracts\HttpClient;

class EndpointTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    /** @test */
    public function it_builds_headers_with_organization_id()
    {
        /** @var HttpClient|MockInterface $http */
        $http = \Mockery::mock(HttpClient::class);
        $endpoint = new DummyEndpoint($http);

        $http->shouldReceive('get')
            ->once()
            ->withArgs([$endpoint->makeRequestUrl(), [], ['organizationId' => 1]]);

        $endpoint->withOrganization(1);
        $endpoint->getAll();
    }

    /** @test */
    public function it_builds_endpoint_url()
    {
        $endpoint = $this->makeEndpoint();

        $this->assertSame('https://favro.com/api/v1/dummy/123', $endpoint->makeRequestUrl(123));
    }

    /**
     * @return DummyEndpoint
     */
    private function makeEndpoint()
    {
        /** @var HttpClient $http */
        $http = \Mockery::mock(HttpClient::class);
        return new DummyEndpoint($http);
    }
}

