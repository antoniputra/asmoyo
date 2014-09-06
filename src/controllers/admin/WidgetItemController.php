<?php

use Antoniputra\Asmoyo\Widgets\ItemRepo;
use Antoniputra\Asmoyo\Widgets\WidgetRepo;

class Admin_WidgetItemController extends AsmoyoController {
	
	protected $collumn 	= 'three_collumn';

	protected $wg_name;

	public function __construct(WidgetRepo $widget, ItemRepo $widgetItem)
	{
		$this->wg_name 		= Request::segment(3);
		$this->widget 		= $widget->setRepoType($this->wg_name);
		$this->widgetItem 	= $widgetItem->setRepoFields( $this->widget->getInfo()['fields'] );
	}

	public function index($widgetSlug)
	{
		$widgets = $this->widget->getRepoAll();
		$data = array(
			'widgets'	=> $widgets,
		);
		return $this->adminView('content.widget.'. $this->wg_name .'.index', $data);
	}

	public function create()
	{
		return 'create new category widget';
	}

	public function show($widgetSlug, $itemSlug)
	{
		$widget 	= $this->widget->getRepoBySlug($itemSlug);
		if ( ! $widget ) return App::abort(404);

		$items 	= $this->widgetItem->getItemByWidgetId($widget['id']);
		$data 	= array(
			'widget'	=> $widget,
			'items'		=> $items,
		);
		return $this->adminView('content.widget.'. $this->wg_name .'.item', $data);
	}

	public function edit($widgetSlug, $itemSlug)
	{
		return 'ini '. $widgetSlug .' edit '. $itemSlug;
	}

	public function forceDestroy($widgetSlug, $itemSlug)
	{
		return 'ini '. $widgetSlug .' delete '. $itemSlug;
	}


	/**
	 * Widget item
	 */
	public function itemIndex()
	{

	}

	public function itemCreate($widgetSlug)
	{
		return 'create new item widget';
	}

	public function itemShow($widgetSlug, $itemSlug)
	{
		return 'create new item widget';
	}

	public function itemForceDestroy($id)
	{
		
	}

	protected function adminViewShare()
	{
		parent::adminViewShare();
		View::share(array(
			'wg'		=> $this->widget->getInfo(),
			'wg_name'	=> $this->wg_name,
        	'wg_path'	=> 'asmoyo::admin.content.widget.'. $this->wg_name .'.',
    	));
	}
}