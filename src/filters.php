<?php

/**
* just anonymous(not logged in) only has allowed access
*/
Route::filter('anonymous', function($route, $request, $value=null)
{
	$value = $value ?: admin_route('home.index');

	if( Auth::check() )
	{
		return Redirect::to($value);
	}
});

/**
* check for admin area
*/
Route::filter('adminFilter', function()
{
	$auth = Auth::user();

	if( !$auth ) return Redirect::to(admin_route('getLogin'));

	if( !isset($auth['permissions']['superuser']) )
	{
		return App::abort(403, 'you don\'t have permission');
	}
});