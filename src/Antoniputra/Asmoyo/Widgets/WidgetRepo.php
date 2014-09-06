<?php namespace Antoniputra\Asmoyo\Widgets;

use Antoniputra\Asmoyo\Cores\Repository;
use Input;

class WidgetRepo extends Repository
{
	protected $validationEditRules = [];

    protected $repo_type;

    /**
     * define relation
     */
    protected $repo_eager   = ['items'];

    /**
     * contain widget name
     */
    protected $widget_name;

	public function __construct(Widget $model)
	{
		$this->model 	= $model;
	}

	/**
	 * set repo type and widget name
	 */
	public function setRepoType($widget_name)
	{
		$this->widget_name 	= $widget_name;
		$this->repo_type 	= 'widget_'. $widget_name;
		return $this;
	}

	public function getInfo()
	{
		$wg_list = app('asmoyo.option.widget');
		$wg_name = $this->widget_name;
		return ($wg_name)
			? $wg_list[$this->widget_name]
			: $wg_list ;
	}
}