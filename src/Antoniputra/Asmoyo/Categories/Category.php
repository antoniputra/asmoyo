<?php namespace Antoniputra\Asmoyo\Categories;

use Antoniputra\Asmoyo\Cores\Entity;

class Category extends Entity {

	protected $table      	= 'categories';
	protected $fillable 	= ['photo_id', 'parent_id', 'title', 'slug', 'status', 'description'];
	protected $softDelete 	= true;

	protected $validationRules = [
        'title'		=> 'required',
        'slug'		=> 'required',
    ];

    public static function boot()
    {
        parent::boot();

        static::saved(function($category)
        {
            \Cache::tags('CategoryRepo')->flush();
        });

        static::deleted(function($category)
        {
            \Cache::tags('CategoryRepo')->flush();
        });
    }

    public function posts()
    {
        return $this->hasMany('Antoniputra\Asmoyo\Posts\Post');
    }
}