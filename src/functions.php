<?php

use Antoniputra\Asmoyo\Cores\Exceptions\GlobalFunctionError;

$GLOBALS['options'] = app('asmoyo.option');

/**
* alias get option
* @param $key
*/
function asmoyo_option($key = null)
{
	if( str_contains($key, '.') )
	{
		$options = array_dot($GLOBALS['options']);
		return $options[$key];
	}

	return $GLOBALS['options'][$key];
}

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
 * get assets current theme path
 */
function theme_assets_path()
{
	// return public_path('asmoyo-theme/'. $option['web_template']['name']);
}