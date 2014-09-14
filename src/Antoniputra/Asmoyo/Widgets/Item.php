<?php namespace Antoniputra\Asmoyo\Widgets;

use Antoniputra\Asmoyo\Cores\Entity;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Item extends Entity {

    use SoftDeletingTrait;

    protected $table      	= 'posts';
	protected $guarded 		= ['type'];
    protected $dates        = ['deleted_at'];

    /**
     * used for caching tags
     */
    protected $cache_name   = 'asmoyo_widgets_items';

    public static function boot()
    {
        parent::boot();

        static::saving(function($model)
        {
            $model->type    	= 'widget_'. \Request::segment(3);
            // $model->category_id = \Request::segment(4);
        });
    }

}