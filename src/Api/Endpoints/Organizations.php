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
        return $this->withOrganization($id)->getById($id);
    }

    /**
     * @param string $itemId
     * @param array $attributes
     * @return mixed
     */
    public function update($itemId, array $attributes)
    {
        return $this->withOrganization($itemId)->update($itemId, $attributes);
    }

    /**
     * {@inheritdoc}
     */
    public function endpoint()
    {
        return 'organizations';
    }
}
