<?php

namespace seregazhuk\Favro;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use seregazhuk\Favro\Contracts\HttpClient;

class GuzzleHttpClient implements HttpClient
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var array
     */
    protected $responseHeaders;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $uri
     * @param array $params
     * @param array $headers
     * @return array
     */
    public function get($uri, array $params = [], array $headers = [])
    {
        if (!empty($params)) {
            $uri .= '?' . http_build_query($params);
        }

        $response = $this
            ->client
            ->get($uri, ['headers' => $headers]);

        return $this->parseResponse($response);
    }

    /**
     * @param string $uri
     * @param array $body
     * @param array $headers
     * @return array
     */
    public function post($uri, array $body = [], array $headers = [])
    {
        $response = $this
            ->client
            ->post(
                $uri, [
                    'headers'     => $headers,
                    'form_params' => $body,
                ]
            );

        return $this->parseResponse($response);
    }

    /**
     * @param string $uri
     * @param array $body
     * @param array $headers
     * @return mixed
     */
    public function put($uri, array $body = [], array $headers = [])
    {
        $response = $this
            ->client
            ->put(
                $uri, [
                    'headers'     => $headers,
                    'form_params' => $body,
                ]
            );

        return $this->parseResponse($response);
    }

    /**
     * @param string $uri
     * @param array $body
     * @param array $headers
     * @return mixed
     */
    public function delete($uri, array $body = [], array $headers = [])
    {
        $response = $this
            ->client
            ->delete($uri, [
                'headers'     => $headers,
                'form_params' => $body,
            ]);

        return $this->parseResponse($response);
    }

    /**
     * @param string $url
     * @return $this
     */
    public function setBaseUrl($url)
    {
        $this->client->setBaseUrl($url);

        return $this;
    }

    /**
     * @param ResponseInterface $response
     * @return array|null
     */
    protected function parseResponse(ResponseInterface $response)
    {
        $responseContents = $response->getBody()->getContents();

        $this->responseHeaders = $response->getHeaders();

        return json_decode($responseContents, true);
    }

    /**
     * @return array
     */
    public function getResponseHeaders()
    {
        return $this->responseHeaders;
    }
}
