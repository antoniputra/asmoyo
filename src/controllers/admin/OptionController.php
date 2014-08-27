<?php

use Antoniputra\Asmoyo\Options\OptionRepo;

class Admin_OptionController extends AsmoyoController {

	/**
	 * Contain Option Repository
	 */
	protected $option;

	public function __construct(OptionRepo $option)
	{
		$this->option = $option;
	}

	/**
	 * Display a listing of the resource.
	 * GET /admin_option
	 *
	 * @return Response
	 */
	public function index()
	{
		return $this->option->getAll();
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /admin_option/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /admin_option
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /admin_option/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /admin_option/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /admin_option/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /admin_option/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}