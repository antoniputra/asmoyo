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
		return "list of installed preference";
	}

	public function create()
	{
		
	}

	public function show($slug)
	{
		
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