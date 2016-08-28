<?php

namespace seregazhuk\tests;

use GuzzleHttp\Client;
use seregazhuk\Favro\GuzzleHttpClient;
use seregazhuk\Favro\Api\Endpoints\Users;
use seregazhuk\Favro\Api\Endpoints\EndpointsContainer;

class EndpointsContainerTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_resolves_an_instance_of_endpoint()
    {
        $container = $this->createContainer();
        $this->assertInstanceOf(Users::class, $container->resolve('users'));
    }

    /**
     * @test
     * @expectedException \seregazhuk\Favro\Exceptions\WrongEndpoint
     */
    public function it_throws_exception_when_resolving_non_existing_endpoint()
    {
        $this->createContainer()
            ->resolve('unknown');
    }

    /**
     * @return EndpointsContainer
     */
    protected function createContainer()
    {
        return new EndpointsContainer(new GuzzleHttpClient(new Client()));
    }
}
