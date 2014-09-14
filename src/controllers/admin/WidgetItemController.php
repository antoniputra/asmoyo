<?php

use Antoniputra\Asmoyo\Widgets\Widget;

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

	public function __construct(Widget $widget)
	{
		$this->widget	= $widget->init( Request::segment(3) );
		$this->category = $this->widget->category();
		$this->item 	= $this->widget->item();
		$this->widget_info = $this->widget->getWidget();
	}

	public function index($widgetSlug)
	{
		$cats 	= $this->category->getRepoAllCache();
		$data 	= array(
			'cats'	=> $cats,
		);
		return $this->adminViewWidget('index', $data);
	}

	public function show($widgetSlug, $catSlug)
	{
		$cat 	= $this->category->requireBySlugCache($catSlug);
		$items 	= $this->item->getItemByWidgetId($cat['id']);
		$data 	= array(
			'cat'	=> $cat,
			'items'	=> $items,
		);
		return $this->adminViewWidget('show', $data);
	}

	public function create($widgetSlug)
	{
		$data 	= [];
		return $this->adminViewWidget('form', $data);
	}

	public function store($widgetSlug)
	{
		$cat 	= $this->category->getNewInstance();
		if ( $this->category->save($cat) )
		{
			return $this->redirectWithAlert(admin_route('widget.cat.index', [$widgetSlug]), 'success', 'Berhasil dibuat !!');
		}
		return $this->redirectWithAlert(false, 'danger', 'Gagal dibuat !!', $cat->getErrors());
	}

	public function edit($widgetSlug, $catSlug)
	{
		$cat 	= $this->category->requireBySlugCache($catSlug);
		$data 	= [
			'cat' => $cat,
		];
		return $this->adminViewWidget('form', $data);
	}

	public function update($widgetSlug, $catSlug)
	{
		$cat = $this->category->requireBySlug($catSlug);
		$cat->fill( $this->category->getInputOnlyFillable() );
		if ( $this->category->save($cat) )
		{
			return $this->redirectWithAlert(admin_route('widget.cat.index', [$widgetSlug]), 'success', 'Berhasil diperbarui !!');
		}
		return $this->redirectWithAlert(false, 'danger', 'Gagal diperbarui !!', $cat->getErrors());
	}

	public function forceDestroy($widgetSlug, $catSlug)
	{
		$cat = $this->category->getRepoBySlug($catSlug);
		$this->category->delete($cat, true);
		return $this->redirectWithAlert(admin_route('widget.cat.index', [$widgetSlug]), 'success', 'Berhasil dihapus permanent !!');
	}


	/**
	 * Widget item
	 */
	public function itemIndex($widgetSlug, $catSlug)
	{
		$cat 	= $this->category->requireBySlugCache($catSlug);
		$items 	= $this->item->getItemByWidgetId($cat['id']);
		$data 	= [
			'cat'	=> $cat,
			'items'	=> $items,
		];
		return $this->adminViewWidget('item_index', $data);
	}

	public function itemShow($widgetSlug, $catSlug, $itemId)
	{
		return 'show item widget';
	}

	public function itemCreate($widgetSlug, $catSlug)
	{
		$cat 	= $this->category->requireBySlugCache($catSlug);
		$data 	= [
			'cat' => $cat,
		];
		return $this->adminViewWidget('item_form', $data);
	}

	public function itemStore($widgetSlug, $catSlug)
	{
		$item 	= $this->item->getNewInstance();
		if ( $this->item->save($item) )
		{
			return $this->redirectWithAlert(admin_route('widget.item.index', [$widgetSlug, $catSlug]), 'success', 'Item Berhasil dibuat !!');
		}
		return $this->redirectWithAlert(false, 'danger', 'Item Gagal dibuat !!', $item->getErrors());
	}

	public function itemEdit($widgetSlug, $catSlug, $itemId)
	{
		$cat 	= $this->category->requireBySlugCache($catSlug);
		$item 	= $this->item->requireById($itemId);
		$data 	= [
			'cat' 	=> $cat,
			'item' 	=> $item
		];
		return $this->adminViewWidget('item_form', $data);
	}

	public function itemUpdate($widgetSlug, $catSlug, $itemId)
	{
		$item 	= $this->item->requireById($itemId);
		$item->fill( Input::only($this->widget_info['fields']) );
		if ( $this->item->save($item) )
		{
			return $this->redirectWithAlert(admin_route('widget.item.index', [$widgetSlug, $catSlug]), 'success', 'Berhasil diperbarui !!');
		}
		return $this->redirectWithAlert(false, 'danger', 'Gagal diperbarui !!', $item->getErrors());
	}

	public function itemForceDestroy($widgetSlug, $catSlug, $itemId)
	{
		$item 	= $this->item->requireById($itemId);
		$this->item->delete($item, true);
		return $this->redirectWithAlert(admin_route('widget.item.index', [$widgetSlug, $catSlug]), 'success', 'Berhasil diperbarui !!');
	}

	protected function adminViewWidget($content, $data = [])
	{
		$widget_path 	= 'content.widget.'. $this->widget_info['name'] .'.';
		return $this->adminView($widget_path . $content, $data);
	}

	protected function adminViewShare()
	{
		parent::adminViewShare();

		View::share([
			'widget'		=> $this->widget_info,
        	'widget_path'	=> 'asmoyo::admin.content.widget.'. $this->widget_info['name'] .'.',
    	]);
	}
}