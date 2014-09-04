<?php namespace Antoniputra\Asmoyo\Preferences;

use Antoniputra\Asmoyo\Cores\Entity;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Preference extends Entity {

    use SoftDeletingTrait;

	protected $table      	= 'categories';
	protected $fillable 	= ['type', 'parent_id', 'title', 'slug', 'status', 'description'];
    protected $dates        = ['deleted_at'];

    /**
     * Contain Type of the model
     * @var string
     */
    protected $relation_type;

    /**
     * used for caching tags
     */
    protected $cache_name   = 'asmoyo_preferences';

    /**
     * Get preference items
     */
    public function datas()
    {
    	return $this->hasMany('Antoniputra\Asmoyo\Posts\Post', 'category_id')->where('type', $this->relation_type);
    }
}