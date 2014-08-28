<?php namespace Antoniputra\Asmoyo\Users;

use Antoniputra\Asmoyo\Cores\Repository;
use Input;

class UserRepo extends Repository
{
	public function __construct(User $model)
	{
		$this->model = $model;
	}

	public function login()
	{
		if (\Auth::attempt( array('email' => Input::get('email'), 'password' => Input::get('password')), Input::get('remember', false) ))
		{
		    return true;
		}
		return false;
	}

	public function logout()
	{
		return \Auth::logout();
	}
}