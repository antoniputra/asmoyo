<?php namespace Antoniputra\Asmoyo\Categories;

use Antoniputra\Asmoyo\Cores\Repository;
use Input;

class CategoryRepo extends Repository
{
	public function __construct(Category $model)
	{
		$this->model = $model;
	}

	/**
	 * get parent category
	 * @param forgetId integer
	 */
	public function getParent($forgetId = null)
	{
		$parent = $this->model->where('parent_id', 0);

		if($forgetId) {
			$parent = $parent->where('id', '!=', $forgetId);
		}

		return $parent->get()->toArray();
	}

}