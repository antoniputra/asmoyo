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
    * Contain Errors
    */
    protected $errors;
    
    /**
    * set repo type
    * used for repo query
    * @var string
    */
    protected $repo_type;

    /**
    * set repo fields
    * used for repo query
    * @var array
    */
    protected $repo_fields;

    /**
     * contain eager loading relations
     * @var array
     */
    protected $repo_eager = [];

    /**
     * Create cache key by given parameter query setting
     * @var string
     */
    protected $repo_cache_key = '';

	public function __construct($model = null)
	{
		$this->model = $model;
	}

	public function getModel()
	{
		return $this->model;
	}

    /**
     * Set repo_fields used by global query repo
     */
    public function setRepoFields($fields)
    {
        $this->repo_fields = $fields;
        return $this;
    }

    /**
     * Set repo_type used by global query repo
     */
    public function setRepoType($type)
    {
        $this->repo_type = $type;
        return $this;
    }

    /**
     * make query by repo_type
     * @param \Model query
     * @return \Model
     */
    public function queryRepo()
    {
        $query = $this->model;
        if ( $repo_fields = $this->repo_fields AND is_array($this->repo_fields) )
        {
            $repo_fields = array_unique($repo_fields);
            $this->repo_cache_key .= implode($repo_fields);
            $query = $query->select($repo_fields);
        }

        if ( $repo_eager = $this->repo_eager AND is_array($this->repo_eager) )
        {
            $this->repo_cache_key .= implode($repo_eager);
            $query = $query->with($repo_eager);
        }

        if ( $repo_type = $this->repo_type )
        {
            $this->repo_cache_key .= $repo_type;
            $query = $query->where('type', $repo_type);
        }

        return $query;
    }

	public function getRepoAll($limit = null, $sortir = null)
    {
        return $this->queryRepo()->get();
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

        $cache_key  = $this->getCacheKey(__FUNCTION__ . implode($data));
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
        return $this->saveToCache($cache_key, $data);
    }

    public function getRepoById($id)
    {
        return $this->queryRepo()->find($id);
    }

    public function getRepoByIdCache($id)
    {
        $key = $this->getCacheKey(__FUNCTION__ . $id);
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
        $key = $this->getCacheKey(__FUNCTION__ . $slug);
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
     * if the given attributes is null, we will skip it.
     */
    public function getNewInstance($attributes = array())
    {
        $attributes = $attributes ?: $this->getInputOnlyFillable() ;

        // filter attributes
        $newAttributes = [];
        foreach ($attributes as $key => $value)
        {
            if ( ! is_null($value) ) {
                $newAttributes[$key] = $value;
            }
        }
        $attributes = $newAttributes;

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
            throw new \Exception("Model should be instanceof Model", 1);
        }
    }

    protected function storeObject($model, $newValidation = array())
    {
        if ( is_array($newValidation) ) {
            $model = $model->setRules($newValidation);
        }

    	// if the model attributes has changed, we will save
        if ($model->getDirty())
        {
            if ( $model->save() )
            {
                 return true;
             }
             $this->errors = $model->getErrors();
             return false;
        }
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
    public function delete($model, $is_permanent = false)
    {
        return $is_permanent ? $model->forceDelete() : $model->delete() ;
    }

    public function isValid($input, $rules = array())
    {
        $validation = \Validator::make($input, $rules);
        $passes     = $validation->passes();
        if( ! $passes ) {
            $this->errors = $validation->messages();
        }

        return $passes;
    }

    /**
     * Get errors
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Set errors
     */
    public function setErrors($msgErrors)
    {
        return $this->errors = $msgErrors;
    }

    /**
     * Get available status list from model
     * @return array
     */
    public function getStatusList()
    {
        return $this->model->getStatusList();
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
    * Stroing value with given key into tagged cache
    * @return mix
    */
    public function saveToCache($key, $value)
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

    /**
     * Create cache key by given parameter query setting
     * @param mix(string|array) additional
     * @return string
     */
    public function getCacheKey($additional)
    {
        $base_key   = $this->repo_cache_key;
        $add_key    = (is_array($additional)) ? implode($additional) : $additional ;
        return $base_key . $add_key;
    }
}