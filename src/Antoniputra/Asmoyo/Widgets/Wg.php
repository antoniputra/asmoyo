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
	 * @return {asmoyo name="widget_bootstrap-carousel" asmoyo}
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
	 * @return View with pseudo query data
	 */
	public function translatePseudo($pseudo)
	{
		$pseudo = trim(str_replace([$this->pseudo_tag[0], $this->pseudo_tag[1]], "", $pseudo));
		$pseudo = str_replace(" ", "&", $pseudo);
		parse_str($pseudo, $result);

		$data = [
			'widget'	=> $this->widgets[$result['name']],
		];
		
		if ( isset($result['category']) ) {
			$data += [
				'wgCat' 	=> $this->wgCategory->getByCategorySlug($result['category']),
			];
		}

		if ( isset($result['item']) ) {
			$data += [
				'wgItem' 	=> $this->wgItem->getById($result['item']),
			];
		}

		return View::make('asmoyo-widget::bootstrap-carousel.default', $data)->render();
	}
}