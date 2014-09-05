<?php

use Antoniputra\Asmoyo\Widgets\WidgetRepo;

class Admin_WidgetItemController extends AsmoyoController {
	
	protected $collumn 	= 'three_collumn';

	protected $widget_name;

	protected $widget;

	public function __construct(WidgetRepo $widget)
	{
		$this->widget_name = Request::segment(3);
		$this->widget = $widget->prepare($this->widget_name);
	}

	public function index()
	{
		$widgets = $this->widget->getPaginated();
		$data = array(
			'widgets'	=> $widgets,
		);
		return $this->adminView('content.widget.'. $this->widget_name .'.index', $data);
	}

	public function create($slug)
	{

	}

	public function show($type, $slug)
	{
		$pref = $this->widget->getDetailBySlug($slug);
		$data = array(
			'pref'	=> $pref,
		);
		return $this->adminView('content.widget.'. $this->widget_name .'.show', $data);
	}

	public function edit($type, $slug)
	{
		$pref = $this->widget->getDetailBySlug($slug);
		$data = array(
			'pref'	=> $pref,
		);
		return $this->adminView('content.widget.'. $this->widget_name .'.edit', $data);
	}

	public function forceDestroy($id)
	{
		
	}

	protected function adminViewShare()
	{
		parent::adminViewShare();
		
		$widget = $this->widget->getInfo();
		View::share(array(
			'wg'		=> $widget,
			'wg_name'	=> $this->widget_name,
        	'wg_path'	=> 'asmoyo::admin.content.widget.'. $this->widget_name .'.',
    	));
	}
}