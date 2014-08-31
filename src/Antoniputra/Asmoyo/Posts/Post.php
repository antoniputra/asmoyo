<?php namespace Antoniputra\Asmoyo\Posts;

use Antoniputra\Asmoyo\Cores\Entity;

class Post extends Entity {
	
    use \SoftDeletingTrait;

	protected $table      	= 'posts';
	protected $fillable 	= [];
    protected $dates        = ['deleted_at'];

	protected $validationRules = [
        'title'    	=> 'required|unique:posts',
        'slug'		=> 'required|unique:posts',
        'content'	=> 'required',
    ];

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