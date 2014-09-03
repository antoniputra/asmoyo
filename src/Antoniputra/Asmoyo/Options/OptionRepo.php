<?php namespace Antoniputra\Asmoyo\Options;

use Antoniputra\Asmoyo\Cores\Repository;

class OptionRepo extends Repository
{
	public function __construct(Option $model)
	{
		$this->model = $model;
	}

	/**
	 * Get all option by option name
	 * @return array
	 */
	public function get($name = null)
	{
		$result = array();
		foreach( $this->model->all() as $opt )
		{
			$result[$opt['name']]	= $opt['value'];
		}
		return ( !$name ) ? $result : $result[$name];
	}

	public function saveOption($input)
	{
		$attr = $input ?: \Input::all();
		if($attr)
		{
			foreach($attr as $key => $val)
			{
				// all element cannot be null except web_side Left and Right
				if( !empty($val) )
				{
					$val = is_array($val) ? json_encode($val) : $val;
					$this->model->where('name', $key)->update(array('value' => $val));
				}
			}

			return true;
		}

		return false;
	}
}