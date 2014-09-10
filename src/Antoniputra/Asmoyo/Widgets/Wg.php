<?php namespace Antoniputra\Asmoyo\Widgets;

use Antoniputra\Asmoyo\Cores\Repository;
use View;

class Wg {

	/**
	 * Contain Widget Lists
	 * @var \OptionRepo
	 */
	protected $widgets;

	/**
	 * Contain Widget Category Repo
	 * @var \wgCategoryRepo
	 */
	protected $wgCategory;

	/**
	 * Contain Widget Item Repo
	 * @var \wgItemRepo
	 */
	protected $wgItem;

	/**
	 * pseudo tag
	 * @var array
	 */
	public $pseudo_tag = ['{asmoyo', 'asmoyo}'];

	public function __construct(WgCategoryRepo $wgCategory, WgItemRepo $wgItem)
	{
		$this->widgets 		= app('asmoyo.option.widget');
		$this->wgCategory 	= $wgCategory;
		$this->wgItem 		= $wgItem;
	}

	public function getAllDetail()
	{
		$results = [];
		if ($this->widgets) {
			foreach ($this->widgets as $name => $value)
			{
				foreach ($this->wgCategory->prepare($name)->getRepoAllCache() as $catValue)
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

	// public function get
	
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
			'widget'	=> $this->widgets[$property['name']],
		];
		
		if ( isset($property['category']) ) {
			$data += [
				'wgCat' 	=> $this->wgCategory->getByCategorySlug($property['category']),
			];
		}

		if ( isset($property['item']) ) {
			$data += [
				'wgItem' 	=> $this->wgItem->getById($property['item']),
			];
		}
		return View::make('asmoyo-widget::'. $type .'.'. $property['name'], $data)->render();
	}
}