<?php namespace Antoniputra\Asmoyo\Cores;

use Illuminate\Database\Eloquent\Model;
use DB, Eloquent, Closure;

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

    /**
     * Create query for list manipulation
     * @param limit
     * @param sortir
     * @param status
     * @param closure
     * @return self
     */
    public function prepareQuery($sortir = null, $limit = null, Closure $closure = null)
    {
        $query = new $this->model;

        switch ($sortir) {
            case 'new':
                $query = $query->orderBy('id', 'desc');
            break;
            
            case 'old':
                $query = $query->orderBy('id', 'asc');
            break;
        }

        if ( $limit AND is_numeric($limit) ) {
            $query = $query->limit($limit);
        }

        if ( $closure ) {
            $query = $closure($query);
        }

        $this->query = $query;
        return $this;
    }

	public function getAll($limit = null, $sortir = null)
    {
        return $this->model->all();
    }

    public function getAllPaginated($limit = null, $sortir = null)
    {
        return $this->model->paginate($limit);
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function getNewInstance($attributes = array())
    {
        return $this->model->newInstance($attributes);
    }

    public function save($newData)
    {
    	// if instance of model. store as object
        if ($newData instanceOf Model)
        {
            return $this->storeObject($newData);
        }
        // is not, set as object first
        elseif (is_array($newData))
        {
            return $this->storeArray($newData);
        }
    }

    protected function storeObject($model)
    {
    	// if the model attributes has changed
    	// we will save
        if ($model->getDirty())
        {
            return $model->save();
        }

        // if not changed store as exception
        else
        {
            // return $model->touch();
            throw new Exception("Save in store object. there is not has change attributes", 1);            
        }
    }

    protected function storeArray($data)
    {
        $model = $this->getNewInstance($data);
        return $this->storeObject($model);
    }
}