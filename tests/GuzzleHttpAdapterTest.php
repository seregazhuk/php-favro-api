<?php

namespace seregazhuk\tests;

use Mockery;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\ClientInterface;
use seregazhuk\Favro\GuzzleHttpClient;

class GuzzleHttpAdapterTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_sets_http_client_base_url()
    {
        $baseUrl = 'http://www.example.com';

        $client = $this->createClient()
            ->shouldReceive('setBaseUrl')
            ->with($baseUrl)
            ->getMock();

        $adapter = new GuzzleHttpClient($client);
        $adapter->setBaseUrl($baseUrl);
    }

    /** @test */
    public function it_proxies_get_request_to_http_client()
    {
        $uri = '/test';
        $params = ['param1' => 'test'];
        $headers = ['header1' => 'test'];


        $client = $this->createClient()
            ->shouldReceive('get')
            ->with(
                $uri  .'?' . http_build_query($params),
                ['headers' => $headers]
            )
            ->andReturn(new Response([]))
            ->getMock();

        $adapter = new GuzzleHttpClient($client);
        $adapter->get($uri, $params, $headers);
    }

    /** @test */
    public function it_proxies_post_request_to_http_client()
    {
        $uri = '/test';
        $body = ['param1' => 'test'];
        $headers = ['header1' => 'test'];


        $client = $this->createClient()
            ->shouldReceive('post')
            ->with(
                $uri,
                ['headers' => $headers, 'form_params' => $body]
            )
            ->andReturn(new Response([]))
            ->getMock();

        $adapter = new GuzzleHttpClient($client);
        $adapter->post($uri, $body, $headers);
    }

    /** @test */
    public function it_proxies_put_request_to_http_client()
    {
        $uri = '/test';
        $body = ['param1' => 'test'];
        $headers = ['header1' => 'test'];


        $client = $this->createClient()
            ->shouldReceive('put')
            ->with(
                $uri,
                ['headers' => $headers, 'form_params' => $body]
            )
            ->andReturn(new Response([]))
            ->getMock();

        $adapter = new GuzzleHttpClient($client);
        $adapter->put($uri, $body, $headers);
    }

    /** @test */
    public function it_proxies_delete_request_to_http_client()
    {
        $uri = '/test';
        $headers = ['header1' => 'test'];


        $client = $this->createClient()
            ->shouldReceive('delete')
            ->with($uri, ['headers' => $headers, 'form_params' => []])
            ->andReturn(new Response([]))
            ->getMock();

        $adapter = new GuzzleHttpClient($client);
        $adapter->delete($uri, [], $headers);
    }

    /**
     * @return \Mockery\MockInterface | ClientInterface
     */
    protected function createClient()
    {
        return \Mockery::mock(ClientInterface::class);
    }

    protected function tearDown()
    {
        Mockery::close();
    }
}
