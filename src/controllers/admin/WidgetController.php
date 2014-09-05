<?php

use Antoniputra\Asmoyo\Widgets\WidgetRepo;

class Admin_WidgetController extends AsmoyoController {
	
	protected $collumn 	= 'three_collumn';

	protected $pref_type;

	public function __construct(WidgetRepo $widget)
	{
		$this->pref_type 	= Request::segment(3);
		$this->widget 	= $widget->setRepoType( $this->pref_type );
	}

	public function index()
	{
		return "list of installed widget";
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
        	'pref_path'		=> 'asmoyo::admin.content.widget.'.$this->pref_type .'.',
    	));
	}
}