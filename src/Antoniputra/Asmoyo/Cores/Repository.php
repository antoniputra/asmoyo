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

	public function getRepoAll($limit = null, $sortir = null)
    {
        return $this->model->all();
    }

    public function getRepoAllPaginated($limit = null, $sortir = null)
    {
        return $this->model->paginate($limit);
    }

    /**
     * Get Paginated Cache with sortir and status setting
     * @param integer   perPage
     * @param string    sortir
     * @param string    status
     * @return array
     */
    public function getRepoPaginatedCache($perPage = null, $sortir = null, $status = null)
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

    public function getRepoById($id)
    {
        return $this->model->find($id);
    }

    public function getRepoByIdCache($id)
    {
        $key = __FUNCTION__ . $id;
        return $this->cache()->rememberForever($key, function() use($id)
        {
            return $this->model->find($id);
        });
    }

    public function getRepoBySlug($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }

    public function getRepoBySlugCache($slug)
    {
        $key = __FUNCTION__ . $slug;
        return $this->cache()->rememberForever($key, function() use($slug)
        {
            return $this->model->where('slug', $slug)->first();
        });
    }

    public function getNewInstance($attributes = array())
    {
        $attributes = $attributes ?: $this->getInputOnlyFillable() ;
        return $this->model->newInstance($attributes);
    }

    /**
     * @param mix $rules
     * @return array newRules
     */
    public function getRules($rules)
    {
        if ( $rules AND is_array($rules) ) {
            $newRules = $rules;
        }

        elseif ($rules) {
            if ( isset($this->$rules) ) {
                $newRules = $this->$rules;
            } else {
                throw new Exception("Undefined property $rules in __CLASS__", 1);
            }
        }
        return $newRules;
    }

    public function save($newData, $newValidation = array())
    {
        // if newData is array, set as new instance
        if (is_array($newData)) {
            $newData = $this->getNewInstance($newData);
        }

        // new data should be instance of model
        if ($newData instanceOf Model)
        {
            return $this->storeObject($newData, $newValidation);
        } else {
            throw new Exception("Model should be instanceof Model", 1);
        }
    }

    protected function storeObject($model, $newValidation = array())
    {
        if ( $newValidation AND is_array($newValidation) ) {
            $model = $model->setRules($newValidation);
        }

    	// if the model attributes has changed, we will save
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
    * Stroing value into tagged cache
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
    * Get value from Tagged Cached by key
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