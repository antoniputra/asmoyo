<?php

class Public_HomeController extends AsmoyoController {
	
	protected $collumn = 'one_collumn';

	public function index()
	{
		$data = array();
		return $this->publicView('content.home', $data);
	}

}