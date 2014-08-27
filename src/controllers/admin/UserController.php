<?php

use Antoniputra\Asmoyo\Users\UserRepo;

class Admin_UserController extends AsmoyoController {

	public function __construct(UserRepo $user)
	{
		$this->user = $user;
	}

	/**
	 * 
	 */
	public function getAdmin()
	{
		return 'check admin auth';
	}

	/**
	 * 
	 */
	public function getAdminLogin()
	{
		$data = array();
		return $this->adminView('user.login', $data);
	}

	/**
	 * 
	 */
	public function postAdminLogin()
	{
		return 'here is Post Admin Login';
	}


	/**
	 * Display a listing of the resource.
	 * GET /post
	 *
	 * @return Response
	 */
	public function index()
	{
		return 'halo';
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /post/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /post
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /post/{id}
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
	 * GET /post/{id}/edit
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
	 * PUT /post/{id}
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
	 * DELETE /post/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}