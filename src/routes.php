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
	Route::get('/', array(
		'before'	=> 'anonymous',
		'as' 		=> $adminPrefix,
		'uses' 		=> 'Admin_UserController@getAdmin'
	));
	Route::get('login', array(
		'before'	=> 'anonymous',
		'as' 		=> $adminPrefix .'.getLogin',
		'uses' 		=> 'Admin_UserController@getLogin'
	));
	Route::post('login', array(
		'before'	=> 'anonymous',
		'as' 		=> $adminPrefix .'.postLogin',
		'uses' 		=> 'Admin_UserController@postLogin'
	));
	Route::get('logout', array(
		'as' 		=> $adminPrefix .'.logout',
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

	// Home
	Route::get('home', array(
		'as'	=> $adminPrefix.'.home.index',
		'uses' 	=> 'Admin_HomeController@index'
	));

	// User
	Route::get('change-password', array(
		'as' 		=> $adminPrefix .'.user.getChangePassword',
		'uses' 		=> 'Admin_UserController@getChangePassword'
	));

	Route::post('change-password', array(
		'as' 		=> $adminPrefix .'.user.postChangePassword',
		'uses' 		=> 'Admin_UserController@postChangePassword'
	));

	// Post
	Route::resource('post', 'Admin_PostController');
});
/* End Admin Page */