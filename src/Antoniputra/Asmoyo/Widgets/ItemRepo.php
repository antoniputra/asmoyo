<?php namespace Antoniputra\Asmoyo\Widgets;

use Antoniputra\Asmoyo\Cores\Repository;
use Input;

class ItemRepo extends Repository
{
	protected $validationEditRules = [];

	public function __construct(Item $model)
	{
		$this->model 	= $model;
	}

	public function getItemByWidgetId($widget_id)
	{
		return $this->queryRepo()->where('category_id', $widget_id)->get();
	}
}