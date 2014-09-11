<?php

use Antoniputra\Asmoyo\Categories\CategoryRepo;
use Antoniputra\Asmoyo\Posts\Blogs\BlogRepo;

class Public_CategoryController extends AsmoyoController
{
	protected $collumn = 'two_collumn';

	public function __construct(CategoryRepo $category, BlogRepo $blog)
	{
		$this->category = $category;
		$this->blog 	= $blog;
	}

	public function index()
	{
		$categories = $this->category->getRepoPaginatedCache();
		$data 	= [
			'categories'	=> Paginator::make($categories, $categories['total'], $categories['perPage']),
			'title'			=> 'Daftar Kategori'
		];
		return $this->publicView('content.category.index', $data);
	}

	public function show($slug)
	{
		$category 	= $this->category->requireBySlugCache($slug);
		$blogs 		= $this->blog->getRepoPaginatedCache();
		$data = [
			'category'	=> $category,
			'blogs'		=> Paginator::make($blogs, $blogs['total'], $blogs['perPage']),
			'title'		=> $category['title'],
		];
		return $this->publicView('content.category.show', $data);
	}
}