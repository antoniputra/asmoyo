<?php

use Antoniputra\Asmoyo\Posts\Pages\PageRepo;

class Public_PageController extends AsmoyoController
{
	protected $collumn = 'two_collumn';

	public function __construct(PageRepo $page)
	{
		$this->page = $page;
	}

	public function show($slug)
	{
		$data = [
			'page'	=> $this->page->requireBySlugCache($slug),
			'title' => true,
		];
		return $this->publicView('content.page.show', $data);
	}
}