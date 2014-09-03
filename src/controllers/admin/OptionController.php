<?php

use Antoniputra\Asmoyo\Options\OptionRepo;

class Admin_OptionController extends AsmoyoController {

	/**
	 * Contain Option Repository
	 */
	protected $option;

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

	public function postWeb()
	{
		return $this->option->getNewInstance();
	}
}