<?php namespace Antoniputra\Asmoyo\Users;

use Antoniputra\Asmoyo\Cores\Repository;

class UserRepo extends Repository
{
	public function __construct(User $model)
	{
		$this->model = $model;
	}
}