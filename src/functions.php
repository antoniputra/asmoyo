<?php

use Antoniputra\Asmoyo\Cores\Exceptions\GlobalFunctionError;

$GLOBALS['options'] 	= app('asmoyo.option.base');
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
 * get image cache using routing 
 * @see Intervention Image Cache
 * @return string|Route
 */
function getImgCache($filename, $type = 'medium')
{
    return route('imagecache', array($type, $filename));
}

/**
 * get original image or manipulated orignal
 * @param string    filename
 * @param array     option
 * @return string|Route
 */
function getImg($filename, $option = array())
{
    $param = null;
    if ($option)
    {
        $optioned = array(
            'w' => isset($option['w']) ? $option['w'] : 300 ,
            'h' => isset($option['h']) ? $option['h'] : 300 ,
        );
        $param = '?'. http_build_query($optioned);
    }
    return route('upload.image', $filename) . $param;
}

function getThumb($filename)
{
    return route('upload.thumb', $filename);
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
function asDropdown($data, $withDefault = false, $option = [])
{
    if ( $withDefault )
        $result[0] = 'Tidak ada';
    else
        $result = [];

    // if $data is object we will use id and title
    if ( is_object($data) OR isset($data[0]['id']) )
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

// get mime type (used for response content type)
function getMime($ext, $default='text/html')
{
    $mimes = array(
        'css'   => 'text/css',
        'js'    => 'text/javascript',
        'jpg'   => 'image/jpg',
        'jpeg'  => 'image/jpeg',
        'png'   => 'image/png',
        'gif'   => 'image/gif',
        'woff'  => 'application/x-font-woff',
    );

    if ( ! array_key_exists($ext, $mimes)) return $default;

    return $mimes[$ext];
}


\View::addNamespace('asmoyo-widget', app_path('views/packages/asmoyo/widget'));


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

/**
* {asmoyo name='bootstrap-carousel' category='banner-utama' asmoyo}
*/
HTML::macro('translatePseudo', function($pseudo)
{
    return app('asmoyo.widget')->translatePseudo($pseudo);
});