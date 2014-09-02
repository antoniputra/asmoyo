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
		'uses' 		=> 'Admin_UserController@admin'
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
});

Route::get($adminPrefix .'/logout', array(
	'as' 		=> $adminPrefix .'.logout',
	'uses' 		=> 'Admin_UserController@logout'
));
/* End Admin Authentication */


/*============
Admin Page
==============*/
Route::group(array('prefix' => $adminPrefix, 'before' => 'adminFilter'), function() use($adminPrefix)
{
	// Home
	Route::get('home', array(
		'as'	=> $adminPrefix.'.home.index',
		'uses' 	=> 'Admin_HomeController@index'
	));
	// End Home

	// Option
	Route::get('option', array(
		'as'	=> $adminPrefix.'.option.index',
		'uses' 	=> 'Admin_OptionController@index'
	));
	// End Option

	// User
	Route::get('change-password', array(
		'as' 		=> $adminPrefix .'.user.getChangePassword',
		'uses' 		=> 'Admin_UserController@getChangePassword'
	));
	Route::put('change-password', array(
		'as' 		=> $adminPrefix .'.user.putChangePassword',
		'uses' 		=> 'Admin_UserController@putChangePassword'
	));
	Route::resource('user', 'Admin_UserController');
	// End User

	// Blog
	Route::resource('blog', 'Admin_BlogController');
	// End Blog

	// Page
	Route::resource('page', 'Admin_PageController');
	// End Page

	// Media
	Route::resource('media', 'Admin_MediaController');
	Route::get('media/froala', array(
		'as' 		=> $adminPrefix .'.media.getFroala',
		'uses' 		=> 'Admin_MediaController@getImage'
	));
	Route::post('media/froala', array(
		'as' 		=> $adminPrefix .'.media.postFroala',
		'uses' 		=> 'Admin_MediaController@postImage'
	));
	Route::delete('media/{id}', array(
		'as'	=> $adminPrefix .'.media.forceDestroy',
		'uses'	=> 'Admin_MediaController@forceDestroy'
	));
	// End Media

	// Category
	Route::resource('category', 'Admin_CategoryController');
	// End Category

	// Tag
	Route::resource('tag', 'Admin_TagController');
	// End Tag

	// Comment
	Route::resource('comment', 'Admin_CommentController');
	// End Comment
});
/*============
End Admin Page
==============*/


/*============
Upload
==============*/

// get image
Route::get('storage/images/{file}', array(
	'as' 		=> 'upload.image',
	'uses' 		=> 'AssetController@getImage'
));

// get image thumbnail
Route::get('storage/thumbs/{file}', array(
	'as' 		=> 'upload.thumb',
	'uses' 		=> 'AssetController@getThumb'
));

/*============
End Upload
==============*/


/*============
Public Page
==============*/

// Category
Route::resource('category', 'CategoryController');
// End Category

// Blog
Route::get('blog/{blog}', array(
	'as'	=> 'blog.show',
	'uses'	=> 'BlogController@show'
));
// End Blog

// Page
Route::get('{page}', array(
	'as'	=> 'page.show',
	'uses'	=> 'PageController@show'
));
// End Page

/*============
End Public Page
==============*/