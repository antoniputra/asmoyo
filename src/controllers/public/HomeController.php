<?php

class Public_HomeController extends AsmoyoController {
	
	protected $collumn = 'one_collumn';

	public function index()
	{
		$data = array(
			'title'	=> 'Home',
		);
		return $this->publicView('content.home', $data);
	}

}