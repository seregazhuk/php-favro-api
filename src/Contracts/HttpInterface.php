<?php

namespace seregazhuk\Favro\Contracts;

interface HttpInterface
{
    /**
     * @param $uri
     * @param array $params
     * @param array $headers
     * @return array
     */
    public function get($uri, $params = [], $headers = []);

    /**
     * @param string $uri
     * @param array $body
     * @param array $headers
     * @return array
     */
    public function post($uri, $body = [], $headers = []);

    /**
     * @param string $uri
     * @param array $body
     * @param array $headers
     * @return mixed
     */
    public function put($uri, $body = [], $headers = []);

    /**
     * @param string $uri
     * @param array $body
     * @param array $headers
     * @return mixed
     */
    public function delete($uri, $body = [], $headers = []);

    /**
     * @param string $url
     * @return $this
     */
    public function setBaseUrl($url);
}