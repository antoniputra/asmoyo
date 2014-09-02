<?php

use Antoniputra\Asmoyo\Posts\Blogs\BlogRepo;

class Admin_BlogController extends AsmoyoController {

	protected $collumn = 'three_collumn';

	public function __construct(BlogRepo $blog)
	{
		$this->blog = $blog;
	}

	/**
	 * Display a listing of the resource.
	 * GET /post
	 *
	 * @return Response
	 */
	public function index()
	{
		$blogs = $this->blog->getRepoPaginatedCache();
		$data 	= array(
			'blogs'	=> Paginator::make($blogs, $blogs['total'], $blogs['perPage']),
		);
		return $this->adminView('content.blog.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /post/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$categoryItems = app('asmoyo.category')->getRepoAll();
		$data = array(
			'statusList'	=> asDropdown($this->blog->getStatusList()),
			'categoryList'	=> asDropdown($categoryItems, true),
		);
		return $this->adminView('content.blog.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /post
	 *
	 * @return Response
	 */
	public function store()
	{
		$blog = $this->blog->getNewInstance();
		if ( $this->blog->save($blog) )
		{
			return $this->redirectWithAlert(admin_route('blog.index'), 'success', 'Berhasil dibuat !!');
		}
		return $this->redirectWithAlert(false, 'danger', 'Gagal dibuat !!', $blog->getErrors());
	}

	/**
	 * Display the specified resource.
	 * GET /post/{slug}
	 *
	 * @param  int  $slug
	 * @return Response
	 */
	public function show($slug)
	{
		$data = array(
			'blog'	=> $this->blog->getDetailBySlugCache($slug),
		);
		// return $data['blog'];
		return $this->adminView('content.blog.show', $data);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /post/{slug}/edit
	 *
	 * @param  int  $slug
	 * @return Response
	 */
	public function edit($slug)
	{
		$blog = $this->blog->requireBySlugCache($slug);
		$categoryItems = app('asmoyo.category')->getRepoAll();
		$data = array(
			'blog'			=> $blog,
			'statusList'	=> asDropdown($this->blog->getStatusList()),
			'categoryList'	=> asDropdown($categoryItems, true),
		);
		return $this->adminView('content.blog.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /post/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$blog 	= $this->blog->requireById($id);
		$blog->fill( $this->blog->getInputOnlyFillable() );
		if ( $this->blog->save($blog) )
		{
			return $this->redirectWithAlert(admin_route('blog.index'), 'success', 'Berhasil diperbarui !!');
		}
		return $this->redirectWithAlert(false, 'danger', 'Gagal diperbarui !!', $blog->getErrors());
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /post/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}