<?php namespace Antoniputra\Asmoyo\Preferences;

use Antoniputra\Asmoyo\Cores\Repository;
use Input;

class PreferenceRepo extends Repository
{
	protected $validationEditRules = [
        'title'     => 'required|unique:categories,title,{id}',
        'slug'      => 'required|unique:categories,slug,{id}',
    ];

    protected $preferenceList = ['banner'];
    protected $repo_fields 	= ['id', 'type', 'parent_id', 'status', 'title', 'slug', 'description'];
    protected $repo_type;
    protected $repo_eager = ['items'];

	public function __construct(Preference $model)
	{
		$this->model = $model;
	}

	public function getPreferenceList()
	{
		return $this->preferenceList;
	}
}