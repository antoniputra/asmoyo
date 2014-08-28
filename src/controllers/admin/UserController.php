<?php

use Antoniputra\Asmoyo\Users\UserRepo;

class Admin_UserController extends AsmoyoController {

	public function __construct(UserRepo $user)
	{
		$this->user = $user;
	}

	/**
	 * base url for admin
	 * this used for check auth admin
	 */
	public function admin()
	{
		return Redirect::to(admin_route('getLogin'));
	}

	/**
	 * 
	 */
	public function getLogin()
	{
		$data = array();
		return $this->setCollumn('two_collumn')->adminView('content.user.login', $data);
	}

	/**
	 * @return Redirect
	 */
	public function postLogin()
	{
		if ($this->user->login(Input::all()))
		{
		    return Redirect::intended(admin_route('home.index'));
		}

		return $this->redirectAlert(false, 'danger', 'Gagal !!', '');
	}

	/**
	* @return Redirect
	*/
	public function logout()
	{
		$this->user->logout();
		return Redirect::to(admin_route('getLogin'));
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