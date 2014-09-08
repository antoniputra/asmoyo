<?php namespace Antoniputra\Asmoyo\Widgets;

use Antoniputra\Asmoyo\Cores\Repository;
use Input;

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
					$results[ 'Widget '.$value['title'] ][] = $catValue;
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
					$results[$widgetName][$catValue['slug']] = $catValue['title'];
				}
			}
		}
		return $results;
	}
	
}