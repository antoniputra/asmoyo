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
		return $this->adminView('content.media.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /post/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /post
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
		$media = $this->media->getRepoBySlugCache($slug);
		if ( ! $media ) return App::abort(404);

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
		//
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
		//
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