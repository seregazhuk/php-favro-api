<?php

namespace seregazhuk\Favro\Api\Endpoints;


class Organizations extends CrudEndpoint
{
    /**
     * @param string $id
     * @return array
     */
    public function getById($id)
    {
        $this->headers['organizationId'] = $id;

        return parent::getById($id);
    }

    /**
     * @param string $itemId
     * @param array $attributes
     * @return mixed
     */
    public function update($itemId, array $attributes)
    {
        $this->headers['organizationId'] = $itemId;

        return parent::update($itemId, $attributes);
    }

    /**
     * @return string
     */
    public function endpoint()
    {
        return 'organizations';
    }
}
