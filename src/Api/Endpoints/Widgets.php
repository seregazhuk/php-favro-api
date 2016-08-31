<?php

namespace seregazhuk\Favro\Api\Endpoints;

class Widgets extends CrudEndpoint
{
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