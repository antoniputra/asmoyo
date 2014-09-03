<?php namespace Antoniputra\Asmoyo\Options;

use Antoniputra\Asmoyo\Cores\Entity;

class Option extends Entity {
	
	protected $table 		= 'options';
	protected $fillable 	= ['name', 'value', 'description', 'type'];
	public $timestamps 		= false;

	/**
     * used for caching tags
     */
    protected $cache_name   = 'asmoyo_options';

	protected $validationRules = [
		'name'			=> 'required',
		'description'	=> 'required',
	];

	public function getValueAttribute($value)
    {
    	if( $this->type == 'json') {
        	return json_decode($value, true);
    	}
    	return $value;
    }
}