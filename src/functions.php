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
 * get asset and upload storage
 */
function getImage($filename, $type = 'medium')
{
    return route('imagecache', array($type, $filename));
}

function getThumb($filename, $size = null)
{
    $setSize = array(
        'w' => isset($size[0]) ? $size[0] : 300 ,
        'h' => isset($size[1]) ? $size[1] : 300 ,
    );
    $param = '?'. http_build_query($setSize);
    return route('upload.thumb', $filename) . $param;
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

/**
 * make data as dropdown
 * @param array data
 * @param bool  withDefault
 * @param array option
 */
function asDropdown(array $data, $withDefault = false, $option = [])
{
    if ( $withDefault )
        $result[0] = 'Tidak ada';
    else
        $result = [];

    // this is multi dimensional array
    if (is_array($data[0]))
    {
        foreach ($data as $d) {
            $result[$d['id']] = $d['title'];
        }
    }
    else
    {
        foreach ($data as $d) {
            $result[$d] = $d;
        }
    }

    return $result;
}


/**
* ===============
* Register Macros
*/
Form::macro('link', function($text, $method, $action, $attr = array(), $confirm_message=null)
{
    // attribute for form
    $formAttr = array('method' => $method, 'url' => $action, 'style' => 'display:inline-block;');

    // append onSubmit
    if($confirm_message) $formAttr = array_merge( $formAttr, array('onsubmit' => 'return confirm("'.$confirm_message.'");') );

    $output = Form::open($formAttr);

    $output .= '<button type="submit"';
        // give attributes
        if (!empty($attr) AND is_array($attr)) {
            foreach ($attr as $key => $value) {
                if ($key != 'icon') {
                    $output .= ' '.$key.'="'. $value .'" ';
                }
            }
        }
    $output .= '>';

    if(isset($attr['icon'])) {
        $output .= '<i class="'.$attr['icon'].'"></i> ';
    }
    
    $output .= $text .'</button>';

    $output .= Form::close();
    
    return $output;
});