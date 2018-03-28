<?php

namespace seregazhuk\Favro\Api\Endpoints;

class Widgets extends CrudEndpoint
{
    /**
     * @param string $itemId
     * @param string|null $collectionId
     * @return mixed
     */
    public function delete($itemId, $collectionId = null)
    {
        $attributes = $collectionId ? ['collectionId' => $collectionId] : [];

        return $this
            ->http
            ->delete(
                $this->makeRequestUrl($itemId),
                $attributes,
                $this->headers()
            );
    }

    /**
     * {@inheritdoc}
     */
    public function endpoint()
    {
        return 'widgets';
    }
}
