<?php

use Antoniputra\Asmoyo\Posts\Medias\MediaRepo;

class Admin_MediaController extends AsmoyoController {

	protected $collumn = 'three_collumn';

	public function __construct(MediaRepo $media)
	{
		$this->media = $media;
	}

	/**
	 * Display a listing of the resource.
	 * GET /post
	 *
	 * @return Response
	 */
	public function index()
	{
		$medias = $this->media->getRepoPaginatedCache();
		$data 	= array(
			'medias'	=> Paginator::make($medias, $medias['total'], $medias['perPage']),
		);
		return $this->setCollumn('two_collumn')->adminView('content.media.index', $data);
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
			'statusList'	=> asDropdown($this->media->getStatusList()),
			'categoryList'	=> asDropdown($categoryItems, true),
		);
		return $this->setCollumn('two_collumn')->adminView('content.media.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /post
	 *
	 * @return Response
	 */
	public function store()
	{
		$media = $this->media->getNewInstance();
		if ( $this->media->save($media) )
		{
			return $this->redirectWithAlert(admin_route('media.index'), 'success', 'Berhasil dibuat !!');
		}
		return $this->redirectWithAlert(false, 'danger', 'Gagal dibuat !!', $media->getErrors());
	}

	/**
	 * Display the specified resource.
	 * GET /post/{slug}
	 *
	 * @param  int  $slug
	 * @return Response
	 */
	public function show($id)
	{
		$media = $this->media->requireByIdCache($id);

		$data = array(
			'media'	=> $media,
		);

		return $this->adminView('content.media.show', $data);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /post/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$media = $this->media->requireByIdCache($id);
		if ( ! $media ) return App::abort(404);

		$categoryItems = app('asmoyo.category')->getRepoAll();
		$data = array(
			'media'			=> $media,
			'statusList'	=> asDropdown($this->media->getStatusList()),
			'categoryList'	=> asDropdown($categoryItems, true),
		);
		return $this->setCollumn('two_collumn')->adminView('content.media.edit', $data);
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
		$media 	= $this->media->requireByIdCache($id);

		$input = $this->media->getInputOnlyFillable();
		$input['content'] = Input::file('content') ?: Input::get('content');
		$media->fill($input);

		if ( $this->media->save($media) )
		{
			return $this->redirectWithAlert(admin_route('media.index'), 'success', 'Berhasil diperbarui !!');
		}
		return $this->redirectWithAlert(false, 'danger', 'Gagal diperbarui !!', $media->getErrors());
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
		$media 	= $this->media->getRepoById($id);
		if( $this->media->delete($media, true) )
		{
			return $this->redirectWithAlert(admin_route('media.index'), 'success', 'Berhasil dihapus !!');
		}
		return $this->redirectWithAlert(false, 'danger', 'Gagal dihapus !!');
	}

}