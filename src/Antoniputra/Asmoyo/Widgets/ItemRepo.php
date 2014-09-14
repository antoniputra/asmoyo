<?php namespace Antoniputra\Asmoyo\Widgets;

use Antoniputra\Asmoyo\Cores\Repository;
use Input;

class ItemRepo extends Repository {

	public function __construct(Item $model)
	{
		$this->model 	= $model;
	}

	public function init($widget_name = null, $widget_fields = null)
	{
		if ($widget_name) {
			$this->repo_type 	= 'widget_'. $widget_name;
		} else {
			$this->repo_where 	= ['type', 'like', '%widget_%'];
		}

		if( $widget_fields )
		{
			$this->repo_fields 	= array_merge(['id'], $widget_fields);
		}

		return $this;
	}

	public function getItemByWidgetId($widget_id)
	{
		$key = $this->getCacheKey(__FUNCTION__.$widget_id);
        return $this->cache()->rememberForever($key, function() use($widget_id)
        {
			return $this->queryRepo()->where('category_id', $widget_id)->get();
		});
	}
}