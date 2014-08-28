<?php namespace Antoniputra\Asmoyo\Posts;

use Antoniputra\Asmoyo\Cores\Entity;

class Post extends Entity {
	
	protected $table      	= 'posts';
	protected $fillable 	= [];
	protected $softDelete 	= true;

	protected $validationRules = [
        'title'    	=> 'required|unique:tags',
        'slug'		=> 'required|unique:tags',
        'content'	=> 'required',
    ];

    /**
     * default posting type
     * probably can update.
     */
    protected $types = ['thread', 'page', 'media'];

    /**
     * get category
     */
    public function category()
    {
        return $this->belongsTo('Antoniputra\Asmoyo\Categories\Category', 'category_id');
    }

    /**
     * get tags
     */
    public function tags()
    {
        return $this->belongsToMany('Antoniputra\Asmoyo\Tags\Tag', 'post_tag');
    }

}