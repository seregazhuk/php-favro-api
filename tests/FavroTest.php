<?php

namespace seregazhuk\tests;

use seregazhuk\Favro\Favro;
use seregazhuk\Favro\Api\Api;

class FavroTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_should_return_an_instance_of_api()
    {
        $this->assertInstanceOf(Api::class, Favro::create('login', 'password'));
    }

    public function it_has_private_constructor()
    {
        $reflection = new \ReflectionClass(Favro::class);
        $this->assertFalse($reflection->getConstructor()->isPublic());
    }

    public function it_has_private_clone_method()
    {
        $reflection = new \ReflectionClass(Favro::class);
        $this->assertFalse($reflection->getMethod('__clone')->isPublic());
    }
}
