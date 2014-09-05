<?php namespace Antoniputra\Asmoyo\Preferences;

use Antoniputra\Asmoyo\Cores\Repository;
use Input;

class PreferenceRepo extends Repository
{
	protected $validationEditRules = [];

    protected $repo_type;
    protected $repo_eager = ['datas'];

    /**
     * The widget name
     */
    protected $name;

	public function __construct(Preference $model)
	{
		$this->model = $model;
	}

	public function at($name)
	{
		$this->name = $name;
		$this->setRepoType('preference_'. $name);
		return $this;
	}

	public function getList()
	{
		return app('asmoyo.option.preference');
	}

	public function getInfo()
	{
		return $this->getList()[$this->name];
	}
}