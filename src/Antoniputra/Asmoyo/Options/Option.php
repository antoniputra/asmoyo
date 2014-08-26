<?php namespace Antoniputra\Asmoyo\Options;

class Option extends \Antoniputra\Asmoyo\Cores\EloquentBase {
	
	protected $table = 'options';

	/**
	* Disabled timestamps
	*/
	public $timestamps = false;

	/**
     * These are the mass-assignable keys
     * @var array
     */
	protected $fillable = [];

	public function getValueAttribute($value)
    {
    	if( $this->type == 'json') {
        	return json_decode($value, true);
    	}
    	return $value;
    }
}