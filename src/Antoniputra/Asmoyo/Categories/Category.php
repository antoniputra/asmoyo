<?php namespace Antoniputra\Asmoyo\Categories;

use Antoniputra\Asmoyo\Cores\Entity;

class Category extends Entity {

	protected $table      	= 'categories';
	protected $fillable 	= ['photo_id', 'parent_id', 'title', 'slug', 'status', 'description'];
	protected $softDelete 	= true;

    protected $validationRules = [
        'title'     => 'required|unique:categories',
        'slug'      => 'required|unique:categories',
    ];

	protected $validationEditRules = [
        'title'		=> 'required|unique:categories,<id>',
        'slug'		=> 'required|unique:categories,<id>',
    ];

    public function posts()
    {
        return $this->hasMany('Antoniputra\Asmoyo\Posts\Post');
    }
}