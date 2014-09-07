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
		'as'	=> $adminPrefix.'.option.getWeb',
		'uses' 	=> 'Admin_OptionController@getWeb'
	));
	Route::put('option', array(
		'as'	=> $adminPrefix.'.option.putWeb',
		'uses' 	=> 'Admin_OptionController@putWeb'
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
	Route::delete('user/{id}/force-delete', array(
		'as'	=> $adminPrefix .'.user.forceDestroy',
		'uses'	=> 'Admin_UserController@forceDestroy'
	));
	Route::resource('user', 'Admin_UserController');
	// End User

	// Blog
	Route::delete('blog/{id}/force-delete', array(
		'as'	=> $adminPrefix .'.blog.forceDestroy',
		'uses'	=> 'Admin_BlogController@forceDestroy'
	));
	Route::resource('blog', 'Admin_BlogController');
	// End Blog

	// Page
	Route::delete('page/{id}/force-delete', array(
		'as'	=> $adminPrefix .'.page.forceDestroy',
		'uses'	=> 'Admin_PageController@forceDestroy'
	));
	Route::resource('page', 'Admin_PageController');
	// End Page

	// Media
	Route::get('media/froala', array(
		'as' 		=> $adminPrefix .'.media.getFroala',
		'uses' 		=> 'Admin_MediaController@getImage'
	));
	Route::post('media/froala', array(
		'as' 		=> $adminPrefix .'.media.postFroala',
		'uses' 		=> 'Admin_MediaController@postImage'
	));
	Route::delete('media/{id}/force-delete', array(
		'as'	=> $adminPrefix .'.media.forceDestroy',
		'uses'	=> 'Admin_MediaController@forceDestroy'
	));
	Route::resource('media', 'Admin_MediaController');
	// End Media

	// Category
	Route::delete('category/{id}/force-delete', array(
		'as'	=> $adminPrefix .'.category.forceDestroy',
		'uses'	=> 'Admin_CategoryController@forceDestroy'
	));
	Route::resource('category', 'Admin_CategoryController');
	// End Category

	// Tag
	Route::delete('tag/{id}/force-delete', array(
		'as'	=> $adminPrefix .'.tag.forceDestroy',
		'uses'	=> 'Admin_TagController@forceDestroy'
	));
	Route::resource('tag', 'Admin_TagController');
	// End Tag

	// Comment
	Route::resource('comment', 'Admin_CommentController');
	// End Comment

	// Widget
	Route::resource('widget', 'Admin_WidgetController', ['only' => ['index', 'create']]);

	if ( app('asmoyo.option.widget') ) {
	foreach (app('asmoyo.option.widget') as $widget)
	{
		// Widget Category
		Route::get('widget/{widget}', array(
			'as'	=> $adminPrefix .'.widget.cat.index',
			'uses'	=> 'Admin_WidgetItemController@index'
		));
		Route::get('widget/{widget}/create', array(
			'as'	=> $adminPrefix .'.widget.cat.create',
			'uses'	=> 'Admin_WidgetItemController@create'
		));
		Route::post('widget/{widget}/store', array(
			'as'	=> $adminPrefix .'.widget.cat.store',
			'uses'	=> 'Admin_WidgetItemController@store'
		));
		Route::get('widget/{widget}/{cat}/edit', array(
			'as'	=> $adminPrefix .'.widget.cat.edit',
			'uses'	=> 'Admin_WidgetItemController@edit'
		));
		Route::put('widget/{widget}/{cat}/update', array(
			'as'	=> $adminPrefix .'.widget.cat.update',
			'uses'	=> 'Admin_WidgetItemController@update'
		));
		Route::delete('widget/{widget}/{cat}/force-delete', array(
			'as'	=> $adminPrefix .'.widget.cat.forceDestroy',
			'uses'	=> 'Admin_WidgetItemController@forceDestroy'
		));
		Route::get('widget/{widget}/{cat}', array(
			'as'	=> $adminPrefix .'.widget.cat.show',
			'uses'	=> 'Admin_WidgetItemController@show'
		));
		// End Widget Category

		// Widget Item
		Route::get('widget/{widget}/{cat}/item', array(
			'as'	=> $adminPrefix .'.widget.item.index',
			'uses'	=> 'Admin_WidgetItemController@itemIndex'
		));
		Route::get('widget/{widget}/{cat}/item/create', array(
			'as'	=> $adminPrefix .'.widget.item.create',
			'uses'	=> 'Admin_WidgetItemController@itemCreate'
		));
		Route::get('widget/{widget}/{cat}/item/{item}/edit', array(
			'as'	=> $adminPrefix .'.widget.item.edit',
			'uses'	=> 'Admin_WidgetItemController@itemEdit'
		));
		Route::get('widget/{widget}/{cat}/item/{item}', array(
			'as'	=> $adminPrefix .'.widget.item.show',
			'uses'	=> 'Admin_WidgetItemController@itemShow'
		));
		Route::delete('widget/{widget}/{cat}/item/{item}/force-delete', array(
			'as'	=> $adminPrefix .'.widget.item.forceDestroy',
			'uses'	=> 'Admin_WidgetItemController@itemForceDestroy'
		));
		// End Widget Item
	} }
	// End Widget
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

Route::get('/', [
	'as'	=> 'home.index',
	'uses'	=> 'Public_HomeController@index'
]);

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
	'uses'	=> 'Public_PageController@show'
));
// End Page

/*============
End Public Page
==============*/