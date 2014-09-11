<?php

use Antoniputra\Asmoyo\Posts\Blogs\BlogRepo;

class Admin_BlogController extends AsmoyoController {

	protected $collumn = 'three_collumn';

	public function __construct(BlogRepo $blog)
	{
		$this->blog = $blog;
	}

	public function index()
	{
		$blogs = $this->blog->getRepoPaginatedCache();
		$data 	= array(
			'blogs'	=> Paginator::make($blogs, $blogs['total'], $blogs['perPage']),
		);
		return $this->adminView('content.blog.index', $data);
	}

	public function create()
	{
		$categoryItems = app('asmoyo.category')->getRepoAll();
		$data = array(
			'title'			=> 'Buat Baru',
			'statusList'	=> as_dropdown($this->blog->getStatusList()),
			'categoryList'	=> as_dropdown($categoryItems, true),
			'widgets'		=> app('asmoyo.widget')->getAllDetailDropdown(),
		);
		return $this->setCollumn('two_collumn')->adminView('content.blog.form', $data);
	}

	public function store()
	{
		$blog = $this->blog->getNewInstance();
		if ( $this->blog->save($blog) )
		{
			return $this->redirectWithAlert(admin_route('blog.index'), 'success', 'Berhasil dibuat !!');
		}
		return $this->redirectWithAlert(false, 'danger', 'Gagal dibuat !!', $blog->getErrors());
	}

	public function show($slug)
	{
		$data = array(
			'blog'	=> $this->blog->getDetailBySlugCache($slug),
		);
		return $this->adminView('content.blog.show', $data);
	}

	public function edit($slug)
	{
		$blog = $this->blog->requireBySlugCache($slug);
		$categoryItems = app('asmoyo.category')->getRepoAll();
		$data = array(
			'blog'			=> $blog->toArray(),
			'title'			=> 'Edit Blog : '. $blog['title'],
			'statusList'	=> as_dropdown($this->blog->getStatusList()),
			'categoryList'	=> as_dropdown($categoryItems, true),
			'widgets'		=> app('asmoyo.widget')->getAllDetailDropdown(),
		);
		return $this->setCollumn('two_collumn')->adminView('content.blog.form', $data);
	}

	public function update($id)
	{
		$blog 	= $this->blog->requireById($id);
		$blog->fill( $this->blog->getInputOnlyFillable() );
		if ( $this->blog->save($blog) )
		{
			return $this->redirectWithAlert(admin_route('blog.index'), 'success', "$blog[title] Berhasil diperbarui !!");
		}
		return $this->redirectWithAlert(false, 'danger', "$blog[title] Gagal diperbarui !!", $blog->getErrors());
	}

	public function destroy($id)
	{
		$blog 	= $this->blog->getRepoById($id);
		if( $this->blog->delete($blog) )
		{
			return $this->redirectWithAlert(admin_route('blog.index'), 'success', 'Berhasil dihapus !!');
		}
		return $this->redirectWithAlert(false, 'danger', 'Gagal dihapus !!');
	}

	public function forceDestroy($id)
	{
		$blog 	= $this->blog->getRepoById($id);
		$this->blog->delete($blog, true);
		
		return $this->redirectWithAlert(admin_route('blog.index'), 'success', 'Berhasil dihapus permanent !!');
	}

}