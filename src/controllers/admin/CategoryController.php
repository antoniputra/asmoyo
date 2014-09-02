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
	 * GET
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
	 * GET
	 *
	 * @return Response
	 */
	public function create()
	{
		$data = array(
			'parentList'	=> asDropdown($this->category->getParent(), true),
			'statusList'	=> asDropdown($this->category->getStatusList()),
		);
		return $this->adminView('content.category.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST
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
	 * GET
	 *
	 * @param  string  $slug
	 * @return Response
	 */
	public function show($slug)
	{
		$cat = $this->category->requireBySlugCache($slug);

		$data = array(
			'cat'	=> $cat,
		);

		return $this->adminView('content.category.show', $data);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($slug)
	{
		$cat = $this->category->requireBySlugCache($slug);
		$data = array(
			'category'		=> $cat,
			'parentList'	=> asDropdown($this->category->getParent($cat['id']), true),
			'statusList'	=> asDropdown($this->category->getStatusList()),
		);
		return $this->adminView('content.category.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$category 	= $this->category->requireById($id);
		$category->fill( $this->category->getInputOnlyFillable() );
		if ( $this->category->save( $category, $this->category->getRules('validationEditRules') ) )
		{
			return $this->redirectWithAlert(admin_route('category.index'), 'success', 'Berhasil diperbarui !!');
		}
		return $this->redirectWithAlert(false, 'danger', 'Gagal diperbarui !!', $category->getErrors());
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$category 	= $this->category->requireById($id);
		if( $this->category->delete($category) )
		{
			return $this->redirectWithAlert(admin_route('category.index'), 'success', 'Berhasil dihapus !!');
		}
		return $this->redirectWithAlert(false, 'danger', 'Gagal dihapus !!');
	}

	/**
	 * Remove Permanent the specified resource from storage.
	 * DELETE
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function forceDestroy($id)
	{
		$category 	= $this->category->getRepoById($id);
		$this->category->delete($category, true);
		
		return $this->redirectWithAlert(admin_route('category.index'), 'success', 'Berhasil dihapus permanent !!');
	}

}