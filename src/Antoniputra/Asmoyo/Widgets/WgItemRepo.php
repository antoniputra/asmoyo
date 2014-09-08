<?php namespace Antoniputra\Asmoyo\Widgets;

use Antoniputra\Asmoyo\Cores\Repository;
use Input;

class WgItemRepo extends Repository {

	public function __construct(WgItem $model)
	{
		$this->model 	= $model;
	}

	public function prepare($widget_name, $widget_fields)
	{
		$this->repo_fields 	= array_merge(['id'], $widget_fields);
		$this->repo_type 	= 'widget_'. $widget_name;
		return $this;
	}

	public function getItemByWidgetId($widget_id)
	{
		return $this->queryRepo()->where('category_id', $widget_id)->get();
	}
}