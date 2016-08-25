<?php

namespace seregazhuk\Favro\Api\Endpoints;

use seregazhuk\Favro\Api\Endpoints\Traits\CrudEndpoint;
use seregazhuk\Favro\Api\Endpoints\Traits\BelongsToOrganization;

class Widgets extends Endpoint
{

    use BelongsToOrganization, CrudEndpoint;

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