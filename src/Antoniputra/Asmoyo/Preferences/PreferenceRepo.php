<?php namespace Antoniputra\Asmoyo\Preferences;

use Antoniputra\Asmoyo\Cores\Repository;
use Input;

class PreferenceRepo extends Repository
{
	protected $validationEditRules = [];

    protected $repo_fields;
    protected $repo_type;
    protected $repo_eager = ['datas'];

    /**
     * The widget list
     */
    protected $list;

    /**
     * The widget info
     */
    protected $info;

	public function __construct(Preference $model)
	{
		$this->model 	= $model;
		$this->list 	= app('asmoyo.option.preference');
	}

	public function at($name)
	{
		$this->info	= $this->list[$name];
		$this->setRepoFields($this->info['fields']);
		$this->setRepoType('preference_'. $name);
		return $this;
	}

	public function getInfo()
	{
		return $this->info;
	}

	public function getList()
	{
		return $this->list;
	}
}