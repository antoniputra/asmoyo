<?php

use Antoniputra\Asmoyo\Widgets\ItemRepo;

class Admin_WidgetItemController extends AsmoyoController {
	
	protected $collumn 	= 'three_collumn';

	protected $widget_name;

	public function __construct(ItemRepo $widgetItem)
	{
		$this->widget_name 	= Request::segment(3);
		$this->widgetItem 	= $widgetItem;
	}

	public function index()
	{
		$widgets = $this->widgetItem->getRepoAll();
		return $widgets;
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
		
	}

	public function edit($type, $slug)
	{

	}

	public function forceDestroy($id)
	{
		
	}

	protected function adminViewShare()
	{
		parent::adminViewShare();
		
		$widget = $this->widgetItem->getInfo();
		View::share(array(
			'wg'		=> $widget,
			'wg_name'	=> $this->widget_name,
        	'wg_path'	=> 'asmoyo::admin.content.widget.'. $this->widget_name .'.',
    	));
	}
}