<?php

use Antoniputra\Asmoyo\Users\UserRepo;

class Admin_UserController extends AsmoyoController {

	protected $collumn = 'three_collumn';

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
		$data = array('login' => true);
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

		return $this->redirectWithAlert(false, 'danger', 'Gagal !!', '');
	}

	/**
	* @return Redirect
	*/
	public function logout()
	{
		$this->user->logout();
		return Redirect::to(admin_route('getLogin'));
	}

	public function getChangePassword()
	{
		$data = [];
		return $this->adminView('content.user.reset_password', $data);
	}

	public function putChangePassword()
	{
		if ( $this->user->saveResetPassword(Input::only('password', 'new_password', 'new_password_confirmation')) )
		{
			return $this->redirectWithAlert(admin_route('user.getChangePassword'), 'success', 'Password Berhasil diubah !!');
		}

		return $this->redirectWithAlert(false, 'danger', 'Password Gagal diubah !!', $this->user->getErrors());
	}


	/**
	 * Display a listing of the resource.
	 * GET /post
	 *
	 * @return Response
	 */
	public function index()
	{
		$users 	= $this->user->getRepoPaginatedCache();
		$data 	= array(
			'users'	=> Paginator::make($users, $users['total'], $users['perPage']),
		);
		return $this->adminView('content.user.index', $data);
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
		$user = $this->user->requireByIdCache($id);
		$data = array(
			'user'	=> $user,
		);
		return $this->adminView('content.user.show', $data);
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

	/**
	 * Remove Permanent the specified resource from storage.
	 * DELETE
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function forceDestroy($id)
	{
		$user 	= $this->user->getRepoById($id);
		$this->user->delete($user, true);
		
		return $this->redirectWithAlert(admin_route('user.index'), 'success', 'Berhasil dihapus permanent !!');
	}

}