<?php namespace Antoniputra\Asmoyo\Categories;

use Antoniputra\Asmoyo\Cores\Repository;
use Input;

class CategoryRepo extends Repository
{
	public function __construct(Category $model)
	{
		$this->model = $model;
	}

	public function browse($sortir = null, $limit = null, $status = null)
	{
		return $this->setQuery($sortir, $limit, $status, function($q) {
				return $q->get();
		})->getQuery();
	}

}