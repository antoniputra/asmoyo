<?php namespace Antoniputra\Asmoyo\Preferences;

use Antoniputra\Asmoyo\Cores\Repository;
use Input;

class PreferenceRepo extends Repository
{
	protected $validationEditRules = [];

    protected $repo_type;

    /**
     * The widget list
     * @var array
     */
    protected $list;

    /**
     * The widget info
     */
    protected $info;

    /**
     * The widget fields
     */
    protected $fields;

	public function __construct(Preference $model)
	{
		$this->model 	= $model;
		$this->list 	= app('asmoyo.option.preference');
	}

	public function prepare($widget_name)
	{
		$this->setRepoType('preference_'. $widget_name);
		$this->info 	= $this->list[$widget_name];
		$this->fields 	= array_unique(array_merge(['id', 'category_id'], $this->info['fields']));
		return $this;
	}

	public function queryBase($type = null)
	{
		$query = $this->queryRepo();
		if($type) {
			$query = $query->where('slug', $type);
		}

		return $query->with(['datas' => function($query)
		{
			return $query->select($this->fields);
		}]);
	}

	public function getPaginated()
	{
		return $this->queryBase()->paginate(10);
	}

	public function getDetailBySlug($slug)
	{
		return $this->queryBase($slug)->first();
	}

	public function getInfo()
	{
		return $this->info;
	}

	public function getFields()
	{
		return $this->fields;
	}
}