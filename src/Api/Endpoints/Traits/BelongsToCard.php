<?php

namespace seregazhuk\Favro\Api\Endpoints\Traits;

trait BelongsToCard {

	/**
	 * @param string $cardCommonId
	 * @return mixed
	 */
	public function getAllForWidget($cardCommonId)
	{
		return parent::getAll(['cardCommonId'=>$cardCommonId]);
	}
}