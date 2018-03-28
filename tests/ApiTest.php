<?php

namespace seregazhuk\tests;

use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;
use seregazhuk\Favro\Api\Api;
use seregazhuk\Favro\Api\Endpoints\Endpoint;
use seregazhuk\Favro\Contracts\HttpClient;
use seregazhuk\Favro\Exceptions\WrongEndpoint;

class ApiTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    /** @test */
    public function it_uses_organization_for_further_requests()
    {
        /** @var HttpClient $http */
        $http = \Mockery::mock(HttpClient::class);
        $endpoint = new DummyEndpoint($http);
        $organizations = new DummyOrganizationsEndpoint($http);

        $http->shouldReceive('get')
            ->once()
            ->withArgs([$endpoint->makeRequestUrl(), [], ['organizationId' => 1]]);

        $api = new Api($http, $endpoint, $organizations);

        $api->useOrganization('test');

        $api->dummy->getAll();
    }

    /** @test */
    public function it_throws_exception_for_wrong_endpoint()
    {
        $this->setExpectedException(WrongEndpoint::class);
        $api = $this->makeApi();
        $api->test->getAll();
    }

    /**
     * @return Api
     */
    private function makeApi()
    {
        /** @var HttpClient $http */
        $http = \Mockery::mock(HttpClient::class);
        return new Api($http, new DummyOrganizationsEndpoint($http));
    }
}

class DummyOrganizationsEndpoint extends Endpoint
{
    /**
     * @return string
     */
    public function endpoint()
    {
        return 'organizations';
    }

    public function getAll(array $params = [])
    {
        return [
            'entities' => [
                [
                    'organizationId' => 1,
                    'name'           => 'test',
                ],
            ],
        ];
    }
}
