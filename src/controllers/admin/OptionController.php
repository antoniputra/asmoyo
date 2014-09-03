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
			'option'	=> asmoyo_option(),
		);
		return $this->adminView('content.option.web', $data);
	}

	public function putWeb()
	{
		$input = Input::all();
		$this->option->saveOption($input);
		return $this->redirectWithAlert(admin_route('option.getWeb'), 'success', 'Berhasil diperbarui !!');
	}
}