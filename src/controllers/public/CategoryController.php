<?php

use Antoniputra\Asmoyo\Posts\Categories\CategoryRepo;

class Public_CategoryController extends AsmoyoController
{
	protected $collumn = 'two_collumn';

	public function __construct(CategoryRepo $category)
	{
		$this->category = $category;
	}

	public function index()
	{
		$categories = $this->category->getRepoPaginatedCache();
		$data 	= [
			'categories'	=> Paginator::make($categories, $categories['total'], $categories['perPage']),
		];
		return $this->publicView('content.category.index', $data);
	}

	public function show($slug)
	{
		$data = [
			'category'	=> $this->category->requireBySlugCache($slug),
		];
		return $this->publicView('content.category.show', $data);
	}
}