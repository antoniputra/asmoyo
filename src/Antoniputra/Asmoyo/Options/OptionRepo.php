<?php namespace Antoniputra\Asmoyo\Options;

use Antoniputra\Asmoyo\Cores\Repository;

class OptionRepo extends Repository
{
	public function __construct(Option $model)
	{
		$this->model = $model;
	}
}