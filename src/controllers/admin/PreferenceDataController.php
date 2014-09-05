<?php

use Antoniputra\Asmoyo\Preferences\PreferenceRepo;

class Admin_PreferenceDataController extends AsmoyoController {
	
	protected $collumn 	= 'three_collumn';

	protected $widget_name;

	protected $widget;

	public function __construct(PreferenceRepo $preference)
	{
		$this->widget_name = Request::segment(3);
		$this->preference = $preference->at($this->widget_name);
	}

	public function index()
	{
		$preferences = $this->preference->getRepoAll();
		$data = array(
			'preferences'	=> $preferences,
		);
		return $this->adminView('content.preference.'. $this->widget_name .'.index', $data);
	}

	public function create()
	{
		$data = array(
			
		);
		return $this->adminView('content.preference.'. $this->widget_name .'.create', $data);
	}

	public function show($type, $slug)
	{
		$pref = $this->preference->requireBySlugCache($slug);
		$data = array(
			'pref'	=> $pref,
		);
		return $this->adminView('content.preference.'. $this->widget_name .'.show', $data);
	}

	public function edit($type, $slug)
	{
		$pref = $this->preference->requireBySlugCache($slug);
		$data = array(
			'pref'	=> $pref,
		);
		return $this->adminView('content.preference.'. $this->widget_name .'.edit', $data);
	}

	public function forceDestroy($id)
	{
		
	}

	protected function adminViewShare()
	{
		parent::adminViewShare();
		
		$widget = $this->preference->getInfo();
		View::share(array(
			'wg'		=> $widget,
			'wg_name'	=> $this->widget_name,
        	'wg_path'	=> 'asmoyo::admin.content.preference.'. $this->widget_name .'.',
    	));
	}
}