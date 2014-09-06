<?php

use Antoniputra\Asmoyo\Widgets\WidgetRepo;

class Admin_WidgetController extends AsmoyoController {
	
	protected $collumn 	= 'three_collumn';

	protected $wg_name;

	public function __construct(WidgetRepo $widget)
	{
		$this->wg_name 	= Request::segment(3);
		$this->widget 	= $widget->setRepoType($this->wg_name);
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
		return 'install new widget';
	}

	public function forceDestroy($id)
	{
		return 'force delete widget';
	}

	protected function adminViewShare()
	{
		parent::adminViewShare();		
		View::share(array(
			'wg'		=> $this->widget->getInfo(),
        	'wg_name'	=> $this->wg_name,
        	'wg_path'	=> 'asmoyo::admin.content.widget.'.$this->wg_name .'.',
    	));
	}
}