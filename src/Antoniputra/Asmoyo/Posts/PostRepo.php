<?php namespace Antoniputra\Asmoyo\Posts;

use Antoniputra\Asmoyo\Cores\Repository;
use Input;

class PostRepo extends Repository
{
	public function __construct(Post $model)
	{
		$this->model = $model;
	}
}