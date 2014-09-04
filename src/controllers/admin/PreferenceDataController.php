<?php

use Antoniputra\Asmoyo\Preferences\PreferenceRepo;

class Admin_PreferenceDataController extends AsmoyoController {
	
	protected $collumn 	= 'three_collumn';

	protected $pref_type;

	public function __construct(PreferenceRepo $preference)
	{
		$this->pref_type 	= Request::segment(3);
		$this->preference 	= $preference->setRepoType( $this->pref_type );
	}

	public function index()
	{
		$preferences = $this->preference->getRepoAll();
		$data = array(
			'preferences'	=> $preferences,
		);
		return $this->adminView('content.preference.'. $this->pref_type .'.index', $data);
	}

	public function create()
	{
		$data = array(
			
		);
		return $this->adminView('content.preference.'. $this->pref_type .'.create', $data);
	}

	public function show($type, $slug)
	{
		$pref = $this->preference->requireBySlugCache($slug);
		$data = array(
			'pref'	=> $pref,
		);
		return $this->adminView('content.preference.'. $this->pref_type .'.show', $data);
	}

	public function edit($type, $slug)
	{
		$pref = $this->preference->requireBySlugCache($slug);
		$data = array(
			'pref'	=> $pref,
		);
		return $this->adminView('content.preference.'. $this->pref_type .'.edit', $data);
	}

	public function forceDestroy($id)
	{
		
	}

	protected function adminViewShare()
	{
		parent::adminViewShare();
		
		View::share(array(
        	'pref_type'		=> $this->pref_type,
        	'pref_path'		=> 'asmoyo::admin.content.preference.'.$this->pref_type .'.',
    	));
	}
}