<?php

class Admin_WidgetController extends AsmoyoController {
	
	protected $collumn 	= 'three_collumn';

	/**
	 * contain widget name by uri segment 3
	 */
	protected $wg_uri;

	/**
	 * contain widget information
	 */
	protected $widget;

	/**
	 * Contain Widget Category
	 */
	protected $wgCategory;

	public function __construct()
	{
		$this->wg_uri 		= Request::segment(3);
		$this->widgets		= app('asmoyo.option.widget');
	}

	public function index()
	{
		$widgets = $this->widgets;
		$data 	= array(
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
			'wg'		=> $this->widget,
        	'wg_uri'	=> $this->wg_uri,
        	'wg_path'	=> 'asmoyo::admin.content.widget.'.$this->wg_uri .'.',
    	));
	}
}