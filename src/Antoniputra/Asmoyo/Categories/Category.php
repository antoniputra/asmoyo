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

    /**
    * set photos attribute to json array
    */
    public function setPhotosAttribute($value)
    {
        $photos_array = explode(',', str_replace(' ', '', $value));
        $this->attributes['photos'] = json_encode($photos_array);
    }

    /**
    * get photos attribute decode from json
    */
    public function getPhotosAttribute($value)
    {
        return json_decode($value, true);
    }

    public function posts()
    {
        return $this->hasMany('Antoniputra\Asmoyo\Posts\Post');
    }
}