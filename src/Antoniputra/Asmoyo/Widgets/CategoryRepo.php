<?php namespace Antoniputra\Asmoyo\Widgets;

use Antoniputra\Asmoyo\Cores\Repository;
use Input;

class CategoryRepo extends Repository {

	public function __construct(Category $model)
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

	public function getByCategorySlug($slug)
	{
		$key = $this->getCacheKey(__FUNCTION__.$slug);
        return $this->cache()->rememberForever($key, function() use($slug)
        {
			return $this->queryRepo()->with(['items'])->where('slug', $slug)->first();
		});
	}

	/**
	 * Delete Model with these items
	 */
	public function delete($model, $is_permanent = false)
	{
		if ($is_permanent) {
			$model->items()->forceDelete();
		} else {
			$model->items()->delete();
		}
		return parent::delete($model, $is_permanent);
	}
}