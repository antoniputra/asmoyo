<?php

use Antoniputra\Asmoyo\Cores\Exceptions\GlobalFunctionError;

$GLOBALS['options'] 	= app('asmoyo.option');
$GLOBALS['theme_dir'] 	= 'asmoyo-theme';

/**
* alias get option
* @param $key
*/
function asmoyo_option($key = null)
{
	if ( ! $key ) return $GLOBALS['options'];

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
 * get current theme assets root path
 */
function theme_asset_path($file = null)
{
	return public_path( $GLOBALS['theme_dir'] .'/'. asmoyo_option('web_theme.name') .'/'. $file);
}

/**
 * get current theme view root path
 */
function theme_view_path($view = null)
{
	return app_path('views/'. $GLOBALS['theme_dir'] .'/'. asmoyo_option('web_theme.name') .'/'. $view);
}

/**
 * get theme file from current active theme, used in template engine
 */
function tpl_get($view = null)
{
	return $GLOBALS['theme_dir'] .'.'. asmoyo_option('web_theme.name') .'.'. $view;
}