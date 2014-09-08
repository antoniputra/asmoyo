<?php namespace Antoniputra\Asmoyo\Widgets;

use Antoniputra\Asmoyo\Cores\Repository;
use Input;

class WidgetRepo extends Repository {

    protected $repo_type;

    /**
     * define relation
     */
    // protected $repo_eager   = ['items'];

    /**
     * contain widget name
     */
    protected $widget_name;

	public function __construct(Widget $model)
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

	/**
	 * 
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