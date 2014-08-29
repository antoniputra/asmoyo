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

    /**
    * Create tags cache. tags key by called class repo
    * @return Cache
    */
    public function cache()
    {
        $tags_keys = array( 'asmoyo_cache', class_basename(get_called_class()) );
        return \Cache::tags($tags_keys);
    }

    /**
    * Set Tagged Cache
    * @return value
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