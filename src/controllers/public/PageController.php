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
		$page = $this->page->requireBySlugCache($slug);
		if ($page['slug'] == 'home') {
			return Redirect::to('/');
		}

		$data = [
			'page'	=> $page,
			'title' => $page['title'],
		];
		return $this->publicView('content.page.show', $data);
	}
}