<?php

namespace seregazhuk\Favro\Api\Endpoints\Traits;

trait BelongsToWidget {

	/**
	 * @param string $widgetCommonId
	 * @return mixed
	 */
	public function getAllForWidget($widgetCommonId)
	{
		return parent::getAll(['widgetCommonId'=>$widgetCommonId]);
	}
}