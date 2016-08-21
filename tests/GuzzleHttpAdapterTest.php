<?php

namespace seregazhuk\tests;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;
use Mockery;
use seregazhuk\Favro\Adapters\GuzzleHttpAdapter;

class GuzzleHttpAdapterTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_sets_http_client_base_url()
    {
        $baseUrl = 'http://www.example.com';

        $http = $this->createHttp()
            ->shouldReceive('setBaseUrl')
            ->with($baseUrl)
            ->getMock();

        $adapter = new GuzzleHttpAdapter($http);
        $adapter->setBaseUrl($baseUrl);
    }

    /** @test */
    public function it_proxies_get_request_to_http_client()
    {
        $uri = '/test';
        $params = ['param1' => 'test'];
        $headers = ['header1' => 'test'];


        $http = $this->createHttp()
            ->shouldReceive('get')
            ->with(
                $uri  .'?' . http_build_query($params),
                ['headers' => $headers]
            )
            ->andReturn(new Response([]))
            ->getMock();

        $adapter = new GuzzleHttpAdapter($http);
        $adapter->get($uri, $params, $headers);
    }

    /** @test */
    public function it_proxies_post_request_to_http_client()
    {
        $uri = '/test';
        $body = ['param1' => 'test'];
        $headers = ['header1' => 'test'];


        $http = $this->createHttp()
            ->shouldReceive('post')
            ->with(
                $uri,
                ['headers' => $headers, 'form_params' => $body]
            )
            ->andReturn(new Response([]))
            ->getMock();

        $adapter = new GuzzleHttpAdapter($http);
        $adapter->post($uri, $body, $headers);
    }

    /** @test */
    public function it_proxies_put_request_to_http_client()
    {
        $uri = '/test';
        $body = ['param1' => 'test'];
        $headers = ['header1' => 'test'];


        $http = $this->createHttp()
            ->shouldReceive('put')
            ->with(
                $uri,
                ['headers' => $headers, 'form_params' => $body]
            )
            ->andReturn(new Response([]))
            ->getMock();

        $adapter = new GuzzleHttpAdapter($http);
        $adapter->put($uri, $body, $headers);
    }

    /**
     * @return \Mockery\MockInterface | ClientInterface
     */
    protected function createHttp()
    {
        return \Mockery::mock(ClientInterface::class);
    }

    /** @test */
    public function it_proxies_delete_request_to_http_client()
    {
        $uri = '/test';
        $headers = ['header1' => 'test'];


        $http = $this->createHttp()
            ->shouldReceive('delete')
            ->with($uri, ['headers' => $headers])
            ->andReturn(new Response([]))
            ->getMock();

        $adapter = new GuzzleHttpAdapter($http);
        $adapter->delete($uri, $headers);
    }

    protected function tearDown()
    {
        Mockery::close();
    }
}
