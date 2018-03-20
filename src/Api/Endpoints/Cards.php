<?php

namespace seregazhuk\Favro\Api\Endpoints;

class Cards extends CrudEndpoint
{
    /**
     * @var string
     */
    protected $endpoint = 'cards';

    /**
     * @param array $params
     * @return array
     */
    public function getAll(array $params)
    {
        return parent::getAll($params);
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
