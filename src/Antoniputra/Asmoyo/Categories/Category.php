<?php namespace Antoniputra\Asmoyo\Categories;

use Antoniputra\Asmoyo\Cores\Entity;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Category extends Entity {

    use SoftDeletingTrait;

	protected $table      	= 'categories';
	protected $fillable 	= ['photo', 'photos', 'parent_id', 'title', 'slug', 'status', 'description'];
    protected $dates        = ['deleted_at'];

    /**
     * Available status list
     */
    public $statusList = ['publish', 'private'];

    /**
     * Default Validation Rules
     */
    protected $validationRules = [
        'title'     => 'required|unique:categories',
        'slug'      => 'required|unique:categories',
    ];

    public function posts()
    {
        return $this->hasMany('Antoniputra\Asmoyo\Posts\Post');
    }
}