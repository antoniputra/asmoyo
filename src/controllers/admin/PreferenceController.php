<?php

use Antoniputra\Asmoyo\Preferences\PreferenceRepo;

class Admin_PreferenceController extends AsmoyoController {
	
	protected $collumn 	= 'three_collumn';

	protected $pref_type;

	public function __construct(PreferenceRepo $preference)
	{
		$this->pref_type 	= Request::segment(3);
		$this->preference 	= $preference->setRepoType( $this->pref_type );
	}

	public function index()
	{
		$preferences = $this->preference->getRepoPaginatedCache();
		$data = array(
			'preferences'	=> Paginator::make($preferences, $preferences['total'], $preferences['perPage']),
		);
		return $this->adminView('content.preference.'. $this->pref_type .'.index', $data);
	}

	protected function adminViewShare()
	{
		parent::adminViewShare();
		
		View::share(array(
        	'pref_type'	=> $this->pref_type,
        	'pref_path'	=> 'preference.'.$this->pref_type
    	));
	}
}