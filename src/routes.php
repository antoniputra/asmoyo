<?php

/* Route Pattern */
Route::pattern('id', '[0-9]+');
Route::pattern('slug', '[A-Za-z0-9-_]+');
Route::pattern('username', '[A-Za-z0-9-_]+');
/* End Route Pattern */

/* Variable */
$adminPrefix = Config::get('asmoyo::admin.prefix');
/* End Variable */

/* Admin Authentication */
Route::group(array('prefix' => $adminPrefix), function() use($adminPrefix)
{
	Route::post('login', array(
		'before'	=> 'anonymous',
		'as' 		=> 'admin.login',
		'uses' 		=> 'Admin_UserController@postAdminLogin'
	));
	Route::get('logout', array(
		'as' 		=> 'admin.logout',
		'uses' 		=> 'Admin_UserController@adminLogout'
	));
});
/* End Admin Authentication */


/* Admin Page */
Route::group(array('prefix' => $adminPrefix, 'before' => 'adminFilter'), function() use($adminPrefix)
{
	// Option
	Route::get('option', array(
		'as'	=> $adminPrefix.'.option.index',
		'uses' 	=> 'Admin_OptionController@index'
	));
});
/* End Admin Page */