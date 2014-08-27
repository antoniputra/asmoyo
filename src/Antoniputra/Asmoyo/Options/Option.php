<?php namespace Antoniputra\Asmoyo\Options;

use Antoniputra\Asmoyo\Cores\Entity;

class Option extends Entity {
	
	protected $table 		= 'options';
	protected $fillable 	= [];
	public $timestamps 		= false;

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