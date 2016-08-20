<?php

namespace seregazhuk\tests;

use seregazhuk\Favro\Favro;

class ApiTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_should_set_organization_id()
    {
        $organizationId = '123456789';
        $api = Favro::create('login', 'password');
        $api->setOrganization($organizationId);

        $this->assertEquals($organizationId, $api->getOrganizationId());
    }
}
