<?php namespace Antoniputra\Asmoyo\Cores;

use Illuminate\Database\Eloquent\Model;
use DB, Eloquent, Closure, Input, Config;

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

	public function getAll($limit = null, $sortir = null)
    {
        return $this->model->all();
    }

    public function getAllPaginated($limit = null, $sortir = null)
    {
        return $this->model->paginate($limit);
    }

    /**
     * Get Paginated Cache with sortir and status setting
     * @param perPage
     * @param sortir
     * @param status
     * @return array
     */
    public function getPaginatedCache($perPage = null, $sortir = null, $status = null)
    {
        // prepare conf variable
        $page = \Input::get('page', 1);
        $data = array(
            'perPage'   => $perPage ?: 10,
            'page'      => is_numeric($page) ? $page : 1,
            'sortir'    => $sortir ?: 'new',
            'status'    => $status ?: 'all',
        );

        $cache_key  = __FUNCTION__ . implode($data);
        if( $cached = $this->getCache($cache_key) ) return $cached;

        $query  = $this->model;

        switch ($data['sortir']) {
            case 'new':
                $query = $query->orderBy('id', 'desc');
            break;
            case 'old':
                $query = $query->orderBy('id', 'asc');
            break;
            case 'title-ascending':
                $query = $query->orderBy('title', 'asc');
            break;
            case 'title-descending':
                $query = $query->orderBy('title', 'desc');
            break;
        }

        if ( $data['status'] AND $data['status'] != 'all' ) {
            $query = $query->where('status', $data['status']);
        }

        // perform total data before calc perPage
        $data['total'] = $query->count();

        if ( $data['perPage'] AND is_numeric($data['perPage']) ) {
            $query = $query->limit($data['perPage']);
        }

        $data['items'] = $query->skip( $data['perPage'] * ($data['page']-1) )
                    ->take($data['perPage'])
                    ->get();
        return $this->setCache($cache_key, $data);
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function getByIdCache($id)
    {
        $key = __FUNCTION__ . $id;
        return $this->modelCache($key)->find($id);
    }

    public function getBySlug($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }

    public function getBySlugCache($slug)
    {
        $key = __FUNCTION__ . $slug;
        return $this->modelCache($key)->where('slug', $slug)->first();
    }

    public function getNewInstance($attributes = array())
    {
        $attributes = $attributes ?: $this->getInputOnlyFillable() ;
        return $this->model->newInstance($attributes);
    }

    public function save($newData, $validation = array())
    {
        // if newData is array, set as new instance
        if (is_array($newData)) {
            $newData = $this->getNewInstance($newData);
        }

        // new data should be instance of model
        if ($newData instanceOf Model)
        {
            if ($validation) {
                $this->model->setRules($validation);
            }

            return $this->storeObject($newData);
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
            return $model->touch();
        }
    }

    /*protected function storeArray($data)
    {
        $model = $this->getNewInstance($data);
        return $this->storeObject($model);
    }*/

    /**
     * Handle Delete
     */
    public function delete($model)
    {
        return $model->delete();
    }

    public function getStatusList()
    {
        return $this->model->statusList;
    }

    /**
     * get based fillable model
    * @return Input
     */
    public function getInputOnlyFillable()
    {
        return Input::only( $this->model->getFillable() );
    }

    /**
     * Perform Model/Eloquent Cache
     * Save model by their table name
     * @return Model/Eloquent with cache declared
     */
    public function modelCache($key)
    {
        $tags_keys = array( 'asmoyo_cache', $this->model->getTable() );
        return $this->model->cacheTags($tags_keys)->rememberForever($key);
    }

    /**
    * Create tags cache. tags key by called class repo
    * Save model by their table name
    * @return Cache
    */
    public function cache()
    {
        $tags_keys = array( 'asmoyo_cache', $this->model->getTable() );
        return \Cache::tags($tags_keys);
    }

    /**
    * Set Tagged Cache
    * @return mix
    */
    public function setCache($key, $value)
    {
        if ($value) {
            $this->cache()->forever($key, $value);
        }
        return $value;
    }

    /**
    * Get Tagged Cached by key
    * @return mix
    */
    public function getCache($key)
    {
        if ( $this->cache()->has($key) )
        {
            return $this->cache()->get($key);
        }
        return false;
    }
}