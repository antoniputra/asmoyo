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

	public function getMedia()
	{
		$data = $this->cache()->rememberForever(__FUNCTION__, function()
        {
        	$result = array();
			foreach( $this->model->where('name', 'like', '%media_%')->get() as $opt )
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
				$name = str_replace('widget_', '', $opt['name']);
				$result[$name] = array(
					'name' 			=> $name,
					'description' 	=> $opt['description']
				);
				$result[$name] += $opt['value'];
			}
			return $result;
		});
		return $data;
	}

	public function saveOption($input = [])
	{
		$attr = $input ?: \Input::except(['_token', '_method']);
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