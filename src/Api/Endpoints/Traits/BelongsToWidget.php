<?php

namespace seregazhuk\Favro\Api\Endpoints\Traits;

trait BelongsToWidget {

	/**
	 * @param string $widgetCommonId
	 * @return mixed
	 */
	public function getAll($widgetCommonId)
	{
		return parent::getAll(['widgetCommonId'=>$widgetCommonId]);
	}
}