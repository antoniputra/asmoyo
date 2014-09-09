<?php namespace Antoniputra\Asmoyo\Posts\Blogs;

use Antoniputra\Asmoyo\Cores\Entity;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Blog extends Entity {

    use SoftDeletingTrait;

	protected $table      	= 'posts';
	protected $fillable 	= ['category_id', 'image', 'images', 'status', 'comment_status', 'mime_type', 'options', 'title', 'slug', 'description', 'content', 'meta_keywords', 'meta_description'];
    protected $guard        = ['user_id', 'type'];
    protected $dates        = ['deleted_at'];

    /**
     * used for caching tags
     */
    protected $cache_name   = 'asmoyo_blogs';

    /**
     * Available status list
     */
    public $statusList = ['publish', 'private'];

    public static function boot()
    {
        parent::boot();

        static::saving(function($model)
        {
            $model->user_id = \Auth::user()->id;
            $model->type    = 'blog';

            $options = $model->getAttribute('options');
            $model->options =  $options ? json_encode($options) : '';
        });
    }

    public function getOptionsAttribute($value)
    {
        return ( ! is_array($value) ) ? json_decode($value, true) : $value;
    }

    /**
     * get category
     */
    public function category()
    {
        return $this->belongsTo('Antoniputra\Asmoyo\Categories\Category', 'category_id');
    }
}