<?php namespace Antoniputra\Asmoyo\Options;

use Antoniputra\Asmoyo\Cores\Repository;

class OptionRepo extends Repository
{
	public function __construct(Option $model)
	{
		$this->model = $model;
	}

	public function get($name = null)
	{
		$result = array();
		foreach( $this->model->all() as $opt )
		{
			$result[$opt['name']]	= $opt['value'];
		}
		return ( !$name ) ? $result : $result[$name];
	}
}