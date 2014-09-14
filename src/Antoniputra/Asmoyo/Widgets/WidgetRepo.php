<?php namespace Antoniputra\Asmoyo\Widgets;

use Antoniputra\Asmoyo\Cores\Repository;
use View;

class WidgetRepo {

	/**
	 * Contain Widget Lists
	 * @var \Antoniputra\Asmoyo\Options\OptionRepo
	 */
	protected $widgets;

	/**
	 * Contain Widget Lists
	 * @var array
	 */
	protected $widget;

	/**
	 * Contain Widget Category Repo
	 * @var \Antoniputra\Asmoyo\Widgets\CategoryRepo
	 */
	protected $category;

	/**
	 * Contain Widget Item Repo
	 * @var \Antoniputra\Asmoyo\Widgets\ItemRepo
	 */
	protected $item;

	/**
	 * pseudo tag
	 * @var array
	 */
	public $pseudo_tag = ['{asmoyo', 'asmoyo}'];

	public function __construct(CategoryRepo $category, ItemRepo $item)
	{
		$this->widgets 		= app('asmoyo.option.widget');
		$this->category 	= $category;
		$this->item 		= $item;
	}

	/**
	 * initialize widget
	 * @param $widget_name
	 */
	public function init($widget_name)
	{
		$this->widget = $this->widgets[$widget_name];
		return $this;
	}

	public function getWidget()
	{
		return $this->widget;
	}

	public function getWidgets()
	{
		return $this->widgets;
	}

	public function getAllDetail()
	{
		$results = [];
		if ($this->widget) {
			foreach ($this->widget as $name => $value)
			{
				foreach ($this->category->prepare($name)->getRepoAllCache() as $catValue)
				{
					$results[$name][] = $catValue;
				}
			}
		}
		return $results;
	}

	public function getAllDetailDropdown($withDefault = true)
	{
		$results = $withDefault ? [0 => 'Tidak ada'] : [];
		if($all = $this->getAllDetail())
		{
			foreach ($all as $widgetName => $widgetCat)
			{
				foreach($widgetCat as $catValue)
				{
					$pseudo = $this->makePseudo($widgetName, $catValue['slug']);
					$results[$widgetName][$pseudo] = $catValue['title'];
				}
			}
		}
		return $results;
	}

	/**
	 * get widget category
	 * @return \Antoniputra\Asmoyo\Widgets\CategoryRepo
	 */
	public function category()
	{
		return $this->category->prepare($this->widget['name']);
	}

	/**
	 * get widget item
	 * @return \Antoniputra\Asmoyo\Widgets\ItemRepo
	 */
	public function item()
	{
		return $this->item->prepare(
			$this->widget['name'],
			$this->widget['fields']
		);
	}
	
	/**
	 * Create pseudo by given key
	 * @return string {asmoyo name=... category=... asmoyo}
	 */
	public function makePseudo($name, $category = null, $item = null)
	{
		$result = '';
		$result .= $this->pseudo_tag[0];

		$result .=  " name=$name "; 
		
		if ($category) {
			$result .= "category=$category ";
		}

		if ($item) {
			$result .= "item=$item ";
		}

		$result .= $this->pseudo_tag[1];
		return $result;
	}

	/**
	 * @param string pseudo
	 * @param string type(header, body, content, sidebar)
	 * @param array option
	 * @return View with pseudo query data
	 */
	public function translatePseudo($pseudo, $type, $additional_prop = [])
	{
		$pseudo = trim(str_replace([$this->pseudo_tag[0], $this->pseudo_tag[1]], "", $pseudo));
		$pseudo = str_replace(" ", "&", $pseudo);
		parse_str($pseudo, $property);

		$property = array_unique(array_merge($property, $additional_prop));

		$data = [
			'property'	=> $property,
			'widget'	=> $this->widget[$property['name']],
		];
		
		if ( isset($property['category']) ) {
			$data += [
				'wgCat' 	=> $this->category->getByCategorySlug($property['category']),
			];
		}

		if ( isset($property['item']) ) {
			$data += [
				'item' 	=> $this->item->getById($property['item']),
			];
		}
		return View::make('asmoyo-widget::'. $type .'.'. $property['name'], $data)->render();
	}
}