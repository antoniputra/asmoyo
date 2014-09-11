<?php

use Antoniputra\Asmoyo\Posts\Medias\MediaRepo;

class Admin_MediaController extends AsmoyoController {

	protected $collumn = 'three_collumn';

	public function __construct(MediaRepo $media)
	{
		$this->media = $media;
	}

	public function index()
	{
		$medias = $this->media->getRepoPaginatedCache();
		$data 	= array(
			'medias'	=> Paginator::make($medias, $medias['total'], $medias['perPage']),
		);
		return $this->setCollumn('two_collumn')->adminView('content.media.index', $data);
	}

	public function create()
	{
		$categoryItems = app('asmoyo.category')->getRepoAll();
		$data = array(
			'statusList'	=> as_dropdown($this->media->getStatusList()),
			'categoryList'	=> as_dropdown($categoryItems, true),

			'title'			=> 'Tambah Media',
		);
		return $this->setCollumn('two_collumn')->adminView('content.media.form', $data);
	}

	public function store()
	{
		$media = $this->media->getNewInstance();
		if ( $this->media->save($media) )
		{
			return $this->redirectWithAlert(admin_route('media.index'), 'success', 'Berhasil dibuat !!');
		}
		return $this->redirectWithAlert(false, 'danger', 'Gagal dibuat !!', $media->getErrors());
	}

	public function show($id)
	{
		$media = $this->media->requireByIdCache($id);

		$data = array(
			'media'	=> $media,
		);

		return $this->adminView('content.media.show', $data);
	}

	public function edit($id)
	{
		$media = $this->media->requireByIdCache($id);
		$categoryItems = app('asmoyo.category')->getRepoAll();
		$data = array(
			'media'			=> $media,
			'statusList'	=> as_dropdown($this->media->getStatusList()),
			'categoryList'	=> as_dropdown($categoryItems, true),

			'title'			=> 'Edit Media : '. $media['title'],
		);
		return $this->setCollumn('two_collumn')->adminView('content.media.form', $data);
	}

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

	public function destroy($id)
	{
		$media 	= $this->media->getRepoById($id);
		if( $this->media->delete($media) )
		{
			return $this->redirectWithAlert(admin_route('media.index'), 'success', 'Berhasil dihapus !!');
		}
		return $this->redirectWithAlert(false, 'danger', 'Gagal dihapus !!');
	}

	public function forceDestroy($id)
	{
		$media 	= $this->media->getRepoById($id);
		if( $this->media->delete($media, true) )
		{
			return $this->redirectWithAlert(admin_route('media.index'), 'success', 'Berhasil dihapus !!');
		}
		return $this->redirectWithAlert(false, 'danger', 'Gagal dihapus !!');
	}

}