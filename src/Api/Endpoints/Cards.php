<?php

namespace seregazhuk\Favro\Api\Endpoints;

use seregazhuk\Favro\Api\Endpoints\Traits\CrudEndpoint;

class Cards extends Endpoint
{

    use CrudEndpoint;

    /**
     * @var string
     */
    protected $endpoint = 'cards';

    /**
     * @param string $widgetCommonId
     * @return mixed
     */
    public function getAll($widgetCommonId)
    {
        return parent::getAll(['widgetCommonId'=>$widgetCommonId]);
    }

    /**
     * @param string $cardId
     * @param bool $everywhere
     * @return mixed
     */
    public function delete($cardId, $everywhere)
    {
        return $this
            ->getHttp()
            ->delete(
                $this->makeRequestUrl($cardId),
                ['everywhere' => $everywhere],
                $this->getHeaders()
            );
    }
}