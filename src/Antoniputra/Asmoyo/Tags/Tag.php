<?php namespace Antoniputra\Asmoyo\Tags;

use Antoniputra\Asmoyo\Cores\Entity;

class Tag extends Entity {

	protected $table      	= 'tags';
	protected $fillable 	= [];
	protected $softDelete 	= true;

	protected $validationRules = [
        'title'		=> 'required|unique:tags',
        'slug'		=> 'required|unique:tags',
    ];

    public function posts()
    {
        return $this->belongsToMany('Antoniputra\Asmoyo\Posts\Post', 'post_tag');
    }
}