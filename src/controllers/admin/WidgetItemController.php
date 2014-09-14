<?php

use Antoniputra\Asmoyo\Widgets\WidgetRepo;

class Admin_WidgetItemController extends AsmoyoController {
	
	protected $collumn 	= 'three_collumn';

	/**
	 * contain widget repository
	 */
	protected $widget;

	/**
	 * contain widget information
	 */
	protected $widget_info;

	/**
	 * Contain Widget Category
	 */
	protected $category;

	/**
	 * Contain Widget Item
	 */
	protected $item;

	public function __construct(WidgetRepo $widget)
	{
		$this->widget	= $widget->init( Request::segment(3) );
		$this->category = $this->widget->category();
		$this->item 	= $this->widget->item();
		$this->widget_info = $this->widget->getWidget();
	}

	public function index($widgetSlug)
	{
		$cats = $this->category->getRepoAll();
		$data = array(
			'cats'	=> $cats,
		);
		return $this->adminViewWidget('index', $data);
	}

	public function show($widgetSlug, $catSlug)
	{
		$widget = $this->category->requireBySlug($catSlug);

		$items 	= $this->item->getItemByWidgetId($widget['id']);
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
		$wgCat = $this->category->getNewInstance();
		if ( $this->category->save($wgCat) )
		{
			return $this->redirectWithAlert(admin_route('widget.cat.index', [$widgetSlug]), 'success', 'Berhasil dibuat !!');
		}
		return $this->redirectWithAlert(false, 'danger', 'Gagal dibuat !!', $wgCat->getErrors());
	}

	public function edit($widgetSlug, $catSlug)
	{
		$wgCat = $this->category->requireBySlug($catSlug);
		$data = array(
			'wgCat' => $wgCat,
		);
		return $this->adminView('content.widget.'. $this->wg_uri .'.form', $data);
	}

	public function update($widgetSlug, $catSlug)
	{
		$wgCat = $this->category->requireBySlug($catSlug);
		$wgCat->fill( $this->category->getInputOnlyFillable() );
		if ( $this->category->save($wgCat) )
		{
			return $this->redirectWithAlert(admin_route('widget.cat.index', [$widgetSlug]), 'success', 'Berhasil diperbarui !!');
		}
		return $this->redirectWithAlert(false, 'danger', 'Gagal diperbarui !!', $wgCat->getErrors());
	}

	public function forceDestroy($widgetSlug, $catSlug)
	{
		$wgCat = $this->category->getRepoBySlug($catSlug);
		$this->category->delete($wgCat, true);
		return $this->redirectWithAlert(admin_route('widget.cat.index', [$widgetSlug]), 'success', 'Berhasil dihapus permanent !!');
	}


	/**
	 * Widget item
	 */
	public function itemIndex($widgetSlug, $catSlug)
	{
		$widget = $this->category->requireBySlug($catSlug);

		$items 	= $this->item->getItemByWidgetId($widget['id']);
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
		$wgCat = $this->category->requireBySlug($catSlug);
		$data = array(
			'wgCat' => $wgCat,
		);
		return $this->adminView('content.widget.'. $this->wg_uri .'.item_form', $data);
	}

	public function itemStore($widgetSlug, $catSlug)
	{
		$item = $this->item->getNewInstance();
		if ( $this->item->save($item) )
		{
			return $this->redirectWithAlert(admin_route('widget.item.index', [$widgetSlug, $catSlug]), 'success', 'Item Berhasil dibuat !!');
		}
		return $this->redirectWithAlert(false, 'danger', 'Item Gagal dibuat !!', $item->getErrors());
	}

	public function itemEdit($widgetSlug, $catSlug, $itemId)
	{
		$wgCat 	= $this->category->requireBySlug($catSlug);
		$item = $this->item->requireById($itemId);
		$data = array(
			'item' 	=> $item,
			'wgCat' 	=> $wgCat,
		);
		return $this->adminView('content.widget.'. $this->wg_uri .'.item_form', $data);
	}

	public function itemUpdate($widgetSlug, $catSlug, $itemId)
	{
		$item = $this->item->requireById($itemId);
		$item->fill( Input::only($this->widget['fields']) );
		if ( $this->item->save($item) )
		{
			return $this->redirectWithAlert(admin_route('widget.item.index', [$widgetSlug, $catSlug]), 'success', 'Berhasil diperbarui !!');
		}
		return $this->redirectWithAlert(false, 'danger', 'Gagal diperbarui !!', $item->getErrors());
	}

	public function itemForceDestroy($widgetSlug, $catSlug, $itemId)
	{
		$item = $this->item->requireById($itemId);
		$this->item->delete($item, true);
		return $this->redirectWithAlert(admin_route('widget.item.index', [$widgetSlug, $catSlug]), 'success', 'Berhasil diperbarui !!');
	}

	protected function adminViewWidget($content, $data = [])
	{
		$widget_path = 'content.widget.'. $this->widget_info['name'] .'.';
		return $this->adminView($widget_path . $content, $data);
	}

	protected function adminViewShare()
	{
		parent::adminViewShare();

		View::share(array(
			'widget'		=> $this->widget_info,
        	'widget_path'	=> 'asmoyo::admin.content.widget.'. $this->widget_info['name'] .'.',
    	));
	}
}