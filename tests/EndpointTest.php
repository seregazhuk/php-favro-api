<?php

namespace seregazhuk\tests;

use PHPUnit\Framework\TestCase;
use seregazhuk\Favro\Api\Endpoints\Endpoint;
use seregazhuk\Favro\Contracts\HttpClient;

class EndpointTest extends TestCase
{
    /** @test */
    public function it_builds_headers_with_organization_id()
    {
        $endpoint = $this->makeEndpoint();

        $endpoint->withOrganization(1);

        $this->assertArraySubset(['organizationId' => 1], $endpoint->getHeaders());

    }

    /** @test */
    public function it_builds_endpoint_url()
    {
        $endpoint = $this->makeEndpoint();

        $this->assertSame('https://favro.com/api/v1/dummy/resource', $endpoint->makeRequestUrl('resource'));
    }

    /**
     * @return DummyEndpoint
     */
    private function makeEndpoint()
    {
        /** @var HttpClient $http */
        $http = \Mockery::mock(HttpClient::class);
        $endpoint = new DummyEndpoint($http);
        return $endpoint;
    }
}


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
