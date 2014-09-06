<?php

use Antoniputra\Asmoyo\Widgets\ItemRepo;
use Antoniputra\Asmoyo\Widgets\WidgetRepo;

class Admin_WidgetItemController extends AsmoyoController {
	
	protected $collumn 	= 'three_collumn';

	protected $wg_name;

	public function __construct(WidgetRepo $widget, ItemRepo $widgetItem)
	{
		$this->wg_name 	= Request::segment(3);
		$this->widget 		= $widget->setRepoType($this->wg_name);
		$this->widgetItem 	= $widgetItem->setRepoFields(['title', 'description']);
	}

	/**
	 * @see WidgetController@show
	 */
	public function index($widgetSlug)
	{
		return 'cok';
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
			'items'	=> $items,
		);
		return $this->adminView('content.widget.'. $this->wg_name .'.item', $data);
	}

	public function edit($widgetSlug, $itemSlug)
	{

	}


	/**
	 * Widget item
	 */

	public function itemCreate($widgetSlug)
	{
		return 'create new item widget';
	}

	public function forceDestroy($id)
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