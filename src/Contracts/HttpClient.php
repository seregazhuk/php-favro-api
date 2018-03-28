<?php

namespace seregazhuk\Favro\Contracts;

interface HttpClient
{
    /**
     * @param string $uri
     * @param array $params
     * @param array $headers
     * @return array
     */
    public function get($uri, array $params = [], array $headers = []);

    /**
     * @param string $uri
     * @param array $body
     * @param array $headers
     * @return array
     */
    public function post($uri, array $body = [], array $headers = []);

    /**
     * @param string $uri
     * @param array $body
     * @param array $headers
     * @return mixed
     */
    public function put($uri, array $body = [], array $headers = []);

    /**
     * @param string $uri
     * @param array $body
     * @param array $headers
     * @return mixed
     */
    public function delete($uri, array $body = [], array $headers = []);

    /**
     * @param string $url
     * @return $this
     */
    public function setBaseUrl($url);

    /**
     * @return array
     */
    public function getResponseHeaders();
}
