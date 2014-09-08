<?php

use Antoniputra\Asmoyo\Posts\Pages\PageRepo;

class Admin_PageController extends AsmoyoController {

	protected $collumn = 'three_collumn';

	public function __construct(PageRepo $page)
	{
		$this->page = $page;
	}

	/**
	 * Display a listing of the resource.
	 * GET
	 *
	 * @return Response
	 */
	public function index()
	{
		$pages = $this->page->getRepoPaginatedCache();
		$data 	= array(
			'pages'		=> Paginator::make($pages, $pages['total'], $pages['perPage']),
		);
		return $this->adminView('content.page.index', $data);
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
			'title'			=> 'Buat Halaman',
			'parentList'	=> asDropdown($this->page->getParent(), true),
			'statusList'	=> asDropdown($this->page->getStatusList()),
			'widgets'		=> app('asmoyo.widget')->getAllDetailDropdown(),
		);
		return $this->setCollumn('two_collumn')->adminView('content.page.form', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST
	 *
	 * @return Response
	 */
	public function store()
	{
		$page = $this->page->getNewInstance();
		if ( $this->page->save($page) )
		{
			return $this->redirectWithAlert(admin_route('page.index'), 'success', 'Berhasil dibuat !!');
		}
		return $this->redirectWithAlert(false, 'danger', 'Gagal dibuat !!', $page->getErrors());
	}

	/**
	 * Display the specified resource.
	 * GET
	 *
	 * @param  int  $slug
	 * @return Response
	 */
	public function show($slug)
	{
		$data = array(
			'page'	=> $this->page->requireBySlugCache($slug),
		);
		return $this->adminView('content.page.show', $data);
	}

	public function edit($slug)
	{
		$page = $this->page->requireBySlugCache($slug);
		$data = array(
			'page'			=> $page->toArray(),
			'title'			=> 'Edit Halaman : '. $page['title'],
			'parentList'	=> asDropdown($this->page->getParent($page['id']), true),
			'statusList'	=> asDropdown($this->page->getStatusList()),
			'widgets'		=> app('asmoyo.widget')->getAllDetailDropdown(),
		);
		return $this->setCollumn('two_collumn')->adminView('content.page.form', $data);
	}

	public function update($id)
	{
		$page 	= $this->page->requireById($id);
		$page->fill( $this->page->getInputOnlyFillable() );
		if ( $this->page->save($page) )
		{
			return $this->redirectWithAlert(admin_route('page.index'), 'success', "$page[title] Berhasil diperbarui !!");
		}
		return $this->redirectWithAlert(false, 'danger', "$page[title] Gagal diperbarui !!", $page->getErrors());
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
		$page 	= $this->page->requireById($id);
		if( $this->page->delete($page) )
		{
			return $this->redirectWithAlert(admin_route('page.index'), 'success', 'Berhasil dihapus !!');
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
		$page 	= $this->page->getRepoById($id);
		$this->page->delete($page, true);
		return $this->redirectWithAlert(admin_route('page.index'), 'success', 'Berhasil dihapus permanent !!');
	}

}