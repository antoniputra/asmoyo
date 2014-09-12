<?php

use Antoniputra\Asmoyo\Options\OptionRepo;

class Admin_OptionController extends AsmoyoController {

	protected $collumn = 'three_collumn';

	public function __construct(OptionRepo $option)
	{
		$this->option = $option;
	}

	public function getWeb()
	{
		$data = array(
			'option'	=> $this->option->getBase(),
			'title'		=> 'Pengaturan Web',
		);
		return $this->adminView('content.option.web', $data);
	}

	public function putWeb()
	{
		return Input::all();
		$this->option->saveOption();
		return $this->redirectWithAlert(admin_route('option.getWeb'), 'success', 'Berhasil diperbarui !!');
	}

	public function getMedia()
	{
		$data = array(
			'media'	=> $this->option->getMedia(),
			'title'		=> 'Pengaturan Media',
		);
		return $this->adminView('content.option.media', $data);
	}

	public function putMedia()
	{
		$this->option->saveOption();
		return $this->redirectWithAlert(admin_route('option.getMedia'), 'success', 'Berhasil diperbarui !!');
	}
}