<?php

use Antoniputra\Asmoyo\Posts\Pages\PageRepo;

class Public_PageController extends AsmoyoController
{
	public function __construct(PageRepo $page)
	{
		$this->page = $page;
	}

	public function show($slug)
	{
		return app('asmoyo.preference.navbar');
	}
}