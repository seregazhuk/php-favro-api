<?php

namespace seregazhuk\Favro\Api\Endpoints;

use seregazhuk\Favro\Api\Endpoints\Traits\CrudEndpoint;

class Widgets extends Endpoint
{

    use CrudEndpoint;

    /**
     * @var string
     */
    protected $endpoint = 'widgets';

    /**
     * @param string $itemId
     * @param string|null $collectionId
     * @return mixed
     */
    public function delete($itemId, $collectionId = null)
    {
        $attributes = $collectionId ? ['collectionId' => $collectionId] : [];

        return $this
            ->getHttp()
            ->delete(
                $this->makeRequestUrl($itemId),
                $attributes,
                $this->getHeaders()
            );
    }
}