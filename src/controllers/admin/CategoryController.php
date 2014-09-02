<?php

use Antoniputra\Asmoyo\Categories\CategoryRepo;

class Admin_CategoryController extends AsmoyoController {

	protected $collumn = 'three_collumn';

	public function __construct(CategoryRepo $category)
	{
		$this->category = $category;
	}

	/**
	 * Display a listing of the resource.
	 * GET /category
	 *
	 * @return Response
	 */
	public function index()
	{
		$cats = $this->category->getRepoPaginatedCache();
		$data = array(
			'categories'	=> Paginator::make($cats, $cats['total'], $cats['perPage']),
		);
		return $this->adminView('content.category.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /category/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$data = array(
			'parentList'	=> $this->category->getParent(),
			'statusList'	=> $this->category->getStatusList(),
		);
		return $this->adminView('content.category.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /category
	 *
	 * @return Redirect
	 */
	public function store()
	{
		$category = $this->category->getNewInstance();
		if ( $this->category->save($category) )
		{
			return $this->redirectWithAlert(admin_route('category.index'), 'success', 'Berhasil dibuat !!');
		}
		return $this->redirectWithAlert(false, 'danger', 'Gagal dibuat !!', $category->getErrors());
	}

	/**
	 * Display the specified resource.
	 * GET /category/{slug}
	 *
	 * @param  string  $slug
	 * @return Response
	 */
	public function show($slug)
	{
		$cat = $this->category->getRepoBySlugCache($slug);
		if ( ! $cat ) return App::abort(404);

		$data = array(
			'cat'	=> $cat,
		);

		return $this->adminView('content.category.show', $data);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /category/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($slug)
	{
		$cat = $this->category->getRepoBySlugCache($slug);
		if ( ! $cat ) return App::abort(404);

		$data = array(
			'category'		=> $cat,
			'parentList'	=> $this->category->getParent($cat['id']),
			'statusList'	=> $this->category->getStatusList(),
		);
		return $this->adminView('content.category.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /category/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$category 	= $this->category->getRepoById($id);
		$category->fill( $this->category->getInputOnlyFillable() );
		if ( $this->category->save( $category, $this->category->getRules('validationEditRules') ) )
		{
			return $this->redirectWithAlert(admin_route('category.index'), 'success', 'Berhasil diperbarui !!');
		}
		return $this->redirectWithAlert(false, 'danger', 'Gagal diperbarui !!', $category->getErrors());
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /category/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$category 	= $this->category->getRepoById($id);
		if( $this->category->delete($category) )
		{
			return $this->redirectWithAlert(admin_route('category.index'), 'success', 'Berhasil dihapus !!');
		}
		return $this->redirectWithAlert(false, 'danger', 'Gagal dihapus !!');
	}

}