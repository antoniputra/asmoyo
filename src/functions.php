<?php

use Antoniputra\Asmoyo\Cores\Exceptions\GlobalFunctionError;

// $web 	= app('asmoyo.option')->get();

/**
 * get admin route
 */
function admin_route($routeName, $param = null)
{
	if ( ! $routeName ) {
		throw new GlobalFunctionError("Error in admin_route", 1);
	}

	$routeName = Config::get('asmoyo::admin.prefix') .'.'. $routeName;
	return ( $param ) ? route($routeName, $param) : route($routeName) ;
}

/**
 * get path current template
 */
