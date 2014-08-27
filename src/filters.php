<?php

/**
* just anonymous(not logged in) only has allowed access
*/
Route::filter('anonymous', function($route, $request, $value=null)
{
	$value = $value ?: 'admin.home.index';

	if( Auth::check() )
	{
		return Redirect::route($value);
	}
});

/**
* check for admin area
*/
Route::filter('adminFilter', function()
{
	/*$user = app('Antoniputra\Asmoyo\Users\UserInterface')->auth();

	if( !$user ) return Redirect::route('admin.login');

	if( !isset($user['permissions']['superuser']) )
	{
		return App::abort(403, 'you don\'t have permission');
	}*/
});