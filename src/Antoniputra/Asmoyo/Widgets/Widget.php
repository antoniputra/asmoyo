<?php namespace Antoniputra\Asmoyo\Widgets;

use Antoniputra\Asmoyo\Cores\Entity;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Widget extends Entity {

    use SoftDeletingTrait;

	protected $table      	= 'categories';
	protected $fillable 	= ['type', 'parent_id', 'title', 'slug', 'status', 'description'];
    protected $dates        = ['deleted_at'];

    /**
     * used for caching tags
     */
    protected $cache_name   = 'asmoyo_preferences';

    /**
     * Get preference items
     */
    public function datas()
    {
    	return $this->hasMany('Antoniputra\Asmoyo\Posts\Post', 'category_id');
    }
}