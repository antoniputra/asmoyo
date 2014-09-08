<?php namespace Antoniputra\Asmoyo\Widgets;

use Antoniputra\Asmoyo\Cores\Entity;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class WgCategory extends Entity {

    use SoftDeletingTrait;

	protected $table      	= 'categories';
	protected $fillable 	= ['image', 'title', 'description'];
    protected $guarded      = ['*'];
    protected $dates        = ['deleted_at'];

    protected $validationRules = [
        'title' => 'required',
    ];

    /**
     * used for caching tags
     */
    protected $cache_name   = 'asmoyo_widgets';

    public static function boot()
    {
        parent::boot();

        static::saving(function($model)
        {
            $model->type    = 'widget_'. \Request::segment(3);
        });
    }

    /**
     * Get widget items
     */
    public function items()
    {
    	return $this->hasMany('Antoniputra\Asmoyo\Widgets\WgItem', 'category_id');
    }
}