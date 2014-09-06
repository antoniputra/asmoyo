<?php

use Antoniputra\Asmoyo\Widgets\WidgetRepo;

class Admin_WidgetController extends AsmoyoController {
	
	protected $collumn 	= 'three_collumn';

	protected $wg_type;

	public function __construct(WidgetRepo $widget)
	{
		$this->wg_type = Request::segment(3);
		$this->widget 	 = $widget->setRepoType( $this->wg_type );
	}

	public function index()
	{
		$widgets = app('asmoyo.option.widget');
		$data = array(
			'widgets'	=> Paginator::make($widgets, count($widgets), 10),
		);
		return $this->adminView('content.widget.index', $data);
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
        	'wg_type'		=> $this->wg_type,
        	'wg_path'		=> 'asmoyo::admin.content.widget.'.$this->wg_type .'.',
    	));
	}
}