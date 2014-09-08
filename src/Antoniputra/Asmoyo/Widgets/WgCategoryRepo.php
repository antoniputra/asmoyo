<?php namespace Antoniputra\Asmoyo\Widgets;

use Antoniputra\Asmoyo\Cores\Repository;
use Input;

class WgCategoryRepo extends Repository {

    /**
     * contain widget name
     */
    protected $widget_name;

	public function __construct(WgCategory $model)
	{
		$this->model 	= $model;
	}

	/**
	 * set repo by requested widget
	 */
	public function prepare($widget_name)
	{
		$this->widget_name 	= $widget_name;
		$this->repo_type 	= 'widget_'. $widget_name;
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