<?php

namespace seregazhuk\Favro\Adapters;

use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;
use seregazhuk\Favro\Contracts\HttpInterface;

class GuzzleHttpAdapter implements HttpInterface
{
    /**
     * @var ClientInterface
     */
    protected $client;
    /**
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $uri
     * @param array $params
     * @param array $headers
     * @return string
     */
    public function get($uri, $params = [], $headers = [])
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
     * @return string
     */
    public function post($uri, $body = [], $headers = [])
    {
        $response = $this
            ->client
            ->post(
                $uri,
                [
                    'headers' => $headers,
                    'form_params' => $body
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
    public function put($uri, $body = [], $headers = [])
    {
        $response = $this
            ->client
            ->put(
                $uri,
                [
                    'headers' => $headers,
                    'form_params'    => $body,
                ]
            );

        return $this->parseResponse($response);
    }

    /**
     * @param string $uri
     * @param array $headers
     * @return mixed
     */
    public function delete($uri, $headers = [])
    {
        $response = $this
            ->client
            ->delete($uri, ['headers' => $headers]);

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

    protected function parseResponse(ResponseInterface $response)
    {
        $responseContents = $response->getBody()->getContents();

        return json_decode($responseContents, true);
    }

}