<?php namespace Antoniputra\Asmoyo\Widgets;

use Antoniputra\Asmoyo\Cores\Entity;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Item extends Entity {

    use SoftDeletingTrait;

    protected $table      	= 'posts';
	protected $fillable 	= [];
    protected $dates        = ['deleted_at'];

    /**
     * used for caching tags
     */
    protected $cache_name   = 'asmoyo_widgets_items';

}