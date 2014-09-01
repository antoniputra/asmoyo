<?php namespace Antoniputra\Asmoyo\Cores;

use Illuminate\Database\Eloquent\Model;
use DB, Eloquent, Closure, Input, Config, Cache;

/**
* Handle base repo
*/
abstract class Repository
{
    /**
    * The Model
    */
    protected $model;
    
    /**
    * set repo type
    * used for repo query
    */
    protected $repo_type;

	public function __construct($model = null)
	{
		$this->model = $model;
	}

	public function getModel()
	{
		return $this->model;
	}

    /**
     * make query by repo_type
     * @param \Model query
     * @return \Model
     */
    private function queryRepo()
    {
        $query = $this->model;
        if ( $repo_type = $this->repo_type )
        {
            $query = $query->where('type', $repo_type);
        }
        return $query;
    }

	public function getRepoAll($limit = null, $sortir = null)
    {
        return $this->queryRepo()->all();
    }

    public function getRepoAllPaginated($limit = null, $sortir = null)
    {
        return $this->queryRepo()->paginate($limit);
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
            'page'      => is_numeric($page) ? $page : 1,
            'perPage'   => $perPage ?: 10,
            'sortir'    => $sortir ?: 'new',
            'status'    => $status ?: 'all',
        );

        $cache_key  = __FUNCTION__ . implode($data);
        if( $cached = $this->getCache($cache_key) ) return $cached;

        $query  = $this->queryRepo();

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
        return $this->queryRepo()->find($id);
    }

    public function getRepoByIdCache($id)
    {
        $key = __FUNCTION__ . $id;
        return $this->cache()->rememberForever($key, function() use($id)
        {
            return $this->queryRepo()->find($id);
        });
    }

    public function requireById($id)
    {
        return $this->getRepoById($id) ?: \App::abort(404);
    }

    public function requireByIdCache($id)
    {
        return $this->getRepoByIdCache($id) ?: \App::abort(404);
    }

    public function getRepoBySlug($slug)
    {
        return $this->queryRepo()->where('slug', $slug)->first();
    }

    public function getRepoBySlugCache($slug)
    {
        $key = __FUNCTION__ . $slug;
        return $this->cache()->rememberForever($key, function() use($slug)
        {
            return $this->queryRepo()->where('slug', $slug)->first();
        });
    }

    public function requireBySlug($slug)
    {
        return $this->getRepoBySlug($slug) ?: \App::abort(404);
    }

    public function requireBySlugCache($slug)
    {
        return $this->getRepoBySlugCache($slug) ?: \App::abort(404);
    }

    /**
     * create new instance.
     */
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

    /**
     * Handle save with new instance and custom validation
     * @param array|object \Model newData
     * @param array newValidation
     * @return Model --> storeObject
     */
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
     * @param \Model model
     * @return bool
     */
    public function delete($model)
    {
        return $model->delete();
    }

    /**
     * Get available status list from model
     * @return array
     */
    public function getStatusList()
    {
        if( isset($this->model->statusList) )
        {
            return $this->model->statusList;
        }
        throw new \Exception("property 'statusList' not defined, maybe this model haven't 'status' field", 1);
    }

    /**
     * get fillable model
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
        $tags_keys = array( 'asmoyo_cache', $this->model->getCacheName() );
        return Cache::tags($tags_keys);
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