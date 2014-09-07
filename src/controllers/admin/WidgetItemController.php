<?php

use Antoniputra\Asmoyo\Widgets\ItemRepo;
use Antoniputra\Asmoyo\Widgets\WidgetRepo;

class Admin_WidgetItemController extends AsmoyoController {
	
	protected $collumn 	= 'three_collumn';

	/**
	 * contain widget name by uri segment 3
	 */
	protected $wg_uri;

	/**
	 * contain widget information
	 */
	protected $widget;

	/**
	 * Contain Widget Category
	 */
	protected $wgCategory;

	/**
	 * Contain Widget Item
	 */
	protected $wgItem;

	public function __construct(WidgetRepo $wgCategory, ItemRepo $wgItem)
	{
		$this->wg_uri 		= Request::segment(3);
		$this->widget		= app('asmoyo.option.widget')[$this->wg_uri];
		$this->wgCategory 	= $wgCategory->setRepoType($this->wg_uri);
		$this->wgItem 		= $wgItem->setRepoFields( $this->widget['fields'] );
	}

	public function index($widgetSlug)
	{
		$widgets = $this->wgCategory->getRepoAll();
		$data = array(
			'widgets'	=> $widgets,
		);
		return $this->adminView('content.widget.'. $this->wg_uri .'.index', $data);
	}

	public function create()
	{
		$data = array(
			
		);
		return $this->adminView('content.widget.'. $this->wg_uri .'.create', $data);
	}

	public function show($widgetSlug, $itemSlug)
	{
		$widget 	= $this->wgCategory->getRepoBySlug($itemSlug);
		if ( ! $widget ) return App::abort(404);

		$items 	= $this->wgItem->getItemByWidgetId($widget['id']);
		$data 	= array(
			'widget'	=> $widget,
			'items'		=> $items,
		);
		return $this->adminView('content.widget.'. $this->wg_uri .'.item', $data);
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
			'wg'		=> $this->widget,
			'wg_uri'	=> $this->wg_uri,
        	'wg_path'	=> 'asmoyo::admin.content.widget.'. $this->wg_uri .'.',
    	));
	}
}