<?php namespace Antoniputra\Asmoyo\Categories;

use Antoniputra\Asmoyo\Cores\Entity;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Category extends Entity {

    use SoftDeletingTrait;

	protected $table      	= 'categories';
	protected $fillable 	= ['image', 'images', 'type', 'parent_id', 'title', 'slug', 'status', 'description'];
    protected $dates        = ['deleted_at'];

    /**
     * used for caching tags
     */
    protected $cache_name   = 'asmoyo_categories';

    /**
     * Available status list
     */
    protected $statusList = ['publish', 'private'];

    /**
     * Default Validation Rules
     */
    protected $validationRules = [
        'title'     => 'required|unique:categories',
        'slug'      => 'required|unique:categories',
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function($model)
        {
            $model->type    = 'category';
        });
    }

    /**
    * set images attribute to json array
    */
    public function setImagesAttribute($value)
    {
        if ($value) {
            $images_array = explode(',', str_replace(' ', '', $value));
            $this->attributes['images'] = json_encode($images_array);
        }
    }

    /**
    * get images attribute decode from json
    */
    public function getImagesAttribute($value)
    {
        return json_decode($value, true);
    }

    public function posts()
    {
        return $this->hasMany('Antoniputra\Asmoyo\Posts\Post');
    }
}