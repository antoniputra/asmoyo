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
	 * set repo type and widget name
	 */
	public function setRepoType($widget_name)
	{
		$this->widget_name 	= $widget_name;
		$this->repo_type 	= 'widget_'. $widget_name;
		return $this;
	}
}