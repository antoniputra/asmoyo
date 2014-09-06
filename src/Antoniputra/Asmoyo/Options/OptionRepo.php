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
	public function getBase()
	{
		$data = $this->cache()->rememberForever(__FUNCTION__, function()
        {
        	$result = array();
			foreach( $this->model->where('name', 'not like', '%widget_%')->get() as $opt )
			{
				$result[$opt['name']]	= $opt['value'];
			}
			return $result;
		});
		return $data;
	}

	public function getWidget()
	{
		$data = $this->cache()->rememberForever(__FUNCTION__, function()
        {
        	$result = array();
			foreach( $this->model->where('name', 'like', '%widget_%')->get() as $opt )
			{
				$name 	= str_replace('widget_', '', $opt['name']);
				$result[$name]	= $opt['value'];
				
				if ( ! isset($opt['value']['description']) ) {
					$result[$name]['description']= $opt['description'];
				}
			}
			return $result;
		});
		return $data;
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
					$this->model->where('name', $key)->save(array('value' => $val));
				}
			}

			return true;
		}

		return false;
	}
}