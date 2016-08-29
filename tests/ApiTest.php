<?php

namespace seregazhuk\tests;

use seregazhuk\Favro\Api\Api;
use seregazhuk\Favro\Favro;

class ApiTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_should_set_organization_id()
    {
        $organizationId = '123456789';
        $api = Favro::create('login', 'password');
        $api->setOrganizationId($organizationId);

        $this->assertEquals($organizationId, $api->getOrganizationId());
    }

    /** @test */
    public function it_should_set_organization_by_name()
    {
        $organization = ['name' => 'My Organization', 'organizationId'=>'123'];

        $api = \Mockery::mock(Api::class)
            ->shouldDeferMissing()
            ->shouldAllowMockingProtectedMethods()
            ->shouldReceive('getOrganizationByName')
            ->andReturn($organization)
            ->getMock();
        $api->setOrganization($organization['name']);

        $this->assertEquals($organization['organizationId'], $api->getOrganizationId());
    }
}
