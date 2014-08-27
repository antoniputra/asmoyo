<?php namespace Antoniputra\Asmoyo\Cores;

use DB, Eloquent;

/**
* Handle base repo
*/
abstract class Repository
{
	/**
	* The Model
	*/
	protected $model;

	public function __construct($model = null)
	{
		$this->model = $model;
	}

	public function getModel()
	{
		return $this->model;
	}

	public function getAll()
    {
        return $this->model->all();
    }

    public function getAllPaginated($count)
    {
        return $this->model->paginate($count);
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }
}