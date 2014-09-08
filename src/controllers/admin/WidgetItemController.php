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
		$this->wgCategory 	= $wgCategory->prepare($this->wg_uri);
		$this->wgItem 		= $wgItem->prepare($this->wg_uri, $this->widget['fields']);
	}

	public function index($widgetSlug)
	{
		$widgets = $this->wgCategory->getRepoAll();
		$data = array(
			'widgets'	=> $widgets,
		);
		return $this->adminView('content.widget.'. $this->wg_uri .'.index', $data);
	}

	public function show($widgetSlug, $catSlug)
	{
		$widget = $this->wgCategory->requireBySlug($catSlug);

		$items 	= $this->wgItem->getItemByWidgetId($widget['id']);
		$data 	= array(
			'widget'	=> $widget,
			'items'		=> $items,
		);
		return $this->adminView('content.widget.'. $this->wg_uri .'.show', $data);
	}

	public function create($widgetSlug)
	{
		$data = array(
			
		);
		return $this->adminView('content.widget.'. $this->wg_uri .'.form', $data);
	}

	public function store($widgetSlug)
	{
		$wgCat = $this->wgCategory->getNewInstance();
		if ( $this->wgCategory->save($wgCat) )
		{
			return $this->redirectWithAlert(admin_route('widget.cat.index', [$widgetSlug]), 'success', 'Berhasil dibuat !!');
		}
		return $this->redirectWithAlert(false, 'danger', 'Gagal dibuat !!', $wgCat->getErrors());
	}

	public function edit($widgetSlug, $catSlug)
	{
		$wgCat = $this->wgCategory->requireBySlug($catSlug);
		$data = array(
			'wgCat' => $wgCat,
		);
		return $this->adminView('content.widget.'. $this->wg_uri .'.form', $data);
	}

	public function update($widgetSlug, $catSlug)
	{
		$wgCat = $this->wgCategory->requireBySlug($catSlug);
		$wgCat->fill( $this->wgCategory->getInputOnlyFillable() );
		if ( $this->wgCategory->save($wgCat) )
		{
			return $this->redirectWithAlert(admin_route('widget.cat.index', [$widgetSlug]), 'success', 'Berhasil diperbarui !!');
		}
		return $this->redirectWithAlert(false, 'danger', 'Gagal diperbarui !!', $wgCat->getErrors());
	}

	public function forceDestroy($widgetSlug, $catSlug)
	{
		return 'ini '. $widgetSlug .' delete '. $catSlug;
	}


	/**
	 * Widget item
	 */
	public function itemIndex($widgetSlug, $catSlug)
	{
		$widget = $this->wgCategory->requireBySlug($catSlug);

		$items 	= $this->wgItem->getItemByWidgetId($widget['id']);
		$data 	= array(
			'widget'	=> $widget,
			'items'		=> $items,
		);
		return $this->adminView('content.widget.'. $this->wg_uri .'.item_index', $data);
	}

	public function itemShow($widgetSlug, $catSlug, $itemId)
	{
		return 'show item widget';
	}

	public function itemCreate($widgetSlug, $catSlug)
	{
		$wgCat = $this->wgCategory->requireBySlug($catSlug);
		$data = array(
			'wgCat' => $wgCat,
		);
		return $this->adminView('content.widget.'. $this->wg_uri .'.item_form', $data);
	}

	public function itemStore($widgetSlug, $catSlug)
	{
		$wgItem = $this->wgItem->getNewInstance();
		if ( $this->wgItem->save($wgItem) )
		{
			return $this->redirectWithAlert(admin_route('widget.item.index', [$widgetSlug, $catSlug]), 'success', 'Item Berhasil dibuat !!');
		}
		return $this->redirectWithAlert(false, 'danger', 'Item Gagal dibuat !!', $wgItem->getErrors());
	}

	public function itemEdit($widgetSlug, $catSlug, $itemId)
	{
		return 'widget edit';
	}

	public function itemForceDestroy($widgetSlug, $catSlug, $itemId)
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