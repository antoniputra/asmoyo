<?php namespace Antoniputra\Asmoyo\Categories;

use Antoniputra\Asmoyo\Cores\Entity;

class Category extends Entity {

	protected $table      	= 'categories';
	protected $fillable 	= [];
	protected $softDelete 	= true;

	protected $validationRules = [
        'title'		=> 'required|unique:categories',
        'slug'		=> 'required|unique:categories',
    ];

    public function posts()
    {
        return $this->hasMany('Antoniputra\Asmoyo\Posts\Post');
    }
}