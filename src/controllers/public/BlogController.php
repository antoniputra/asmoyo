<?php

use Antoniputra\Asmoyo\Posts\Blogs\BlogRepo;

class Public_BlogController extends AsmoyoController
{
	protected $collumn = 'two_collumn';

	public function __construct(BlogRepo $blog)
	{
		$this->blog = $blog;
	}

	public function index()
	{
		$blogs = $this->blog->getRepoPaginatedCache();
		$data 	= [
			'blogs'	=> Paginator::make($blogs, $blogs['total'], $blogs['perPage']),
			'title'	=> "Daftar Blog",
		];
		return $this->publicView('content.blog.index', $data);
	}

	public function show($slug)
	{
		$data = [
			'blog'	=> $this->blog->requireBySlugCache($slug),
			'title'	=> true,
		];
		return $this->publicView('content.blog.show', $data);
	}
}