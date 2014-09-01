<?php namespace Antoniputra\Asmoyo\Posts\Medias;

use Antoniputra\Asmoyo\Cores\Entity;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Media extends Entity {

    use SoftDeletingTrait;

	protected $table      	= 'posts';
	protected $fillable = ['user_id', 'category_id', 'status', 'comment_status', 'type', 'mime_type', 'size', 'title', 'slug', 'description', 'content', 'meta_keywords', 'meta_description'];
    protected $dates        = ['deleted_at'];

    /**
     * used for caching tags
     */
    protected $cache_name   = 'asmoyo_medias';

    /**
     * Available status list
     */
    public $statusList = ['publish', 'visible', 'private'];

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
            $model->type    = 'media';
        });
    }
}