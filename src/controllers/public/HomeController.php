<?php

class Public_HomeController extends AsmoyoController {
	
	protected $collumn = 'one_collumn';

	public function index()
	{
		$blogs['items'] = app('asmoyo.blog')->getRepoAllCache(3);
		$data 	= array(
			'blogs'	=> $blogs,
			'title'	=> 'Home',
		);
		return $this->publicView('content.home', $data);
	}

}