<?php namespace Antoniputra\Asmoyo\Users;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Antoniputra\Asmoyo\Cores\Entity;

class User extends Entity implements UserInterface, RemindableInterface {
	
	use UserTrait, RemindableTrait;

	protected $table 		= 'users';
	protected $fillable 	= ['email', 'username', 'password', 'permissions', 'activated', 'activation_code', 'activated_at', 'last_login', 'photo', 'fullname', 'birthday', 'gender', 'city', 'address', 'location', 'description'];
	protected $hidden 		= array('password', 'remember_token');

	/**
     * used for caching tags
     */
    protected $cache_name   = 'asmoyo_users';
	
	protected $validationRules = [
		'email'			=> 'required|unique:users',
		'password'		=> 'required|confirmed|min:6',
		'username'		=> 'required|min:4',
		'fullname'		=> 'required',
		'birthday'      => 'required|date',
        'gender'        => 'required|in:male,female',
        'city'          => 'required',
	];

	public function getPermissionsAttribute($value)
    {
        return json_decode($value, true);
    }

    public function setPermissionsAttribute($value)
    {
        $this->attributes['permissions'] = json_encode($value);
    }

}