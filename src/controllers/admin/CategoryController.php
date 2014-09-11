<?php

use Antoniputra\Asmoyo\Categories\CategoryRepo;

class Admin_CategoryController extends AsmoyoController {

	protected $collumn = 'three_collumn';

	public function __construct(CategoryRepo $category)
	{
		$this->category = $category;
	}

	public function index()
	{
		$cats = $this->category->getRepoPaginatedCache();
		$data = array(
			'categories'	=> Paginator::make($cats, $cats['total'], $cats['perPage']),
		);
		return $this->adminView('content.category.index', $data);
	}

	public function create()
	{
		$data = array(
			'parentList'	=> as_dropdown($this->category->getParent(), true),
			'statusList'	=> as_dropdown($this->category->getStatusList()),
			'title'			=> 'Buat Kategori',
		);
		return $this->adminView('content.category.form', $data);
	}

	public function store()
	{
		$category = $this->category->getNewInstance();
		if ( $this->category->save($category) )
		{
			return $this->redirectWithAlert(admin_route('category.index'), 'success', 'Berhasil dibuat !!');
		}
		return $this->redirectWithAlert(false, 'danger', 'Gagal dibuat !!', $category->getErrors());
	}

	public function show($slug)
	{
		$cat = $this->category->requireBySlugCache($slug);

		$data = array(
			'cat'	=> $cat,
		);

		return $this->adminView('content.category.show', $data);
	}

	public function edit($slug)
	{
		$cat = $this->category->requireBySlugCache($slug);
		$data = array(
			'category'		=> $cat,
			'parentList'	=> as_dropdown($this->category->getParent($cat['id']), true),
			'statusList'	=> as_dropdown($this->category->getStatusList()),
			'title'			=> 'Edit Kategori : '. $cat['title'],
		);
		return $this->adminView('content.category.form', $data);
	}

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

	public function destroy($id)
	{
		$category 	= $this->category->requireById($id);
		if( $this->category->delete($category) )
		{
			return $this->redirectWithAlert(admin_route('category.index'), 'success', 'Berhasil dihapus !!');
		}
		return $this->redirectWithAlert(false, 'danger', 'Gagal dihapus !!');
	}

	public function forceDestroy($id)
	{
		$category 	= $this->category->getRepoById($id);
		$this->category->delete($category, true);
		
		return $this->redirectWithAlert(admin_route('category.index'), 'success', 'Berhasil dihapus permanent !!');
	}

}