<?php namespace Antoniputra\Asmoyo\Categories;

use Antoniputra\Asmoyo\Cores\Entity;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Category extends Entity {

    use SoftDeletingTrait;

	protected $table      	= 'categories';
	protected $fillable 	= ['photo_id', 'parent_id', 'title', 'slug', 'status', 'description'];
    protected $dates        = ['deleted_at'];

    protected $validationRules = [
        'title'     => 'required|unique:categories',
        'slug'      => 'required|unique:categories',
    ];

    public function posts()
    {
        return $this->hasMany('Antoniputra\Asmoyo\Posts\Post');
    }
}