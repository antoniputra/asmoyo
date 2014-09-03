<?php namespace Antoniputra\Asmoyo\Users;

use Antoniputra\Asmoyo\Cores\Repository;
use Input;

class UserRepo extends Repository
{
	protected $validation_resetPassword = [
		'password' 		=> 'required',
		'new_password'	=> 'required|confirmed|min:6'
	];

	public function __construct(User $model)
	{
		$this->model = $model;
	}

	public function auth()
	{
		return \Auth::user();
	}

	public function login()
	{
		if (\Auth::attempt( array('email' => Input::get('email'), 'password' => Input::get('password')), Input::get('remember', false) ))
		{
		    return true;
		}
		return false;
	}

	public function resetPassword($input)
	{
		if ( ! $this->isValid($input, $this->validation_resetPassword) ) {
			return false;
		}

		$auth = $this->auth();
		if ( ! \Hash::check($input['password'], $auth['password']) ) return false;

		$user = $this->requireById( $auth['id'] );
		$user->fill([
			'password' => \Hash::make($input['new_password'])
		]);
		return $this->save($user, array());
	}

	public function logout()
	{
		return \Auth::logout();
	}
}