<?php namespace Antoniputra\Asmoyo\Posts\Pages;

use Antoniputra\Asmoyo\Cores\Entity;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Page extends Entity {

    use SoftDeletingTrait;

	protected $table      	= 'posts';
	protected $fillable 	= ['user_id', 'parent_id', 'image', 'images', 'status', 'comment_status', 'type', 'order', 'mime_type', 'size', 'options', 'title', 'slug', 'description', 'content', 'meta_keywords', 'meta_description'];
    protected $dates        = ['deleted_at'];

    /**
     * used for caching tags
     */
    protected $cache_name   = 'asmoyo_pages';

    /**
     * Available status list
     */
    public $statusList = ['publish', 'private'];

    /**
     * Default Validation Rules
     */
    protected $validationRules = [
        'title'     => 'required',
        'content'   => 'required'
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function($model)
        {
            $model->user_id = \Auth::user()->id;
            $model->type    = 'page';
            $model->order 	= rand(7, 17);
        });
    }
}