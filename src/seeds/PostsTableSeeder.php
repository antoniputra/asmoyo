<?php

class PostsTableSeeder extends Seeder {

	public function run()
	{
		DB::table('posts')->truncate();

		/**
		* For Media
		*/
		$medias = array(
			'user_id'				=> 1,
			'category_id'			=> 0,
			'status'				=> 'visible',
			'comment_status'		=> 1,
			'type'					=> 'media',
			'mime_type'				=> 'image/jpg',
			'size'					=> '2500',
			'options'				=> json_encode(array()),
			'title'					=> 'Example Image',
			'slug'					=> 'example-image',
			'description'			=> 'ini adalah example image',
			'content'				=> 'example.jpg',
			'meta_keywords'			=> 'some keywords 1, some keywords 2',
			'meta_description'		=> 'some long descriptions',
			'created_at'			=> \Carbon\Carbon::now(),
			'updated_at'			=> \Carbon\Carbon::now(),
		);
		DB::table('posts')->insert($medias);

		/**
		* For Page
		*/
		$pages = array(
			'parent_id'				=> 0,
			'user_id'				=> 1,
			'image'					=> null,
			'images'				=> json_encode(array()),
			'status'				=> 'publish',
			'comment_status'		=> 1,
			'type'					=> 'page',
			'order'					=> 0,
			'mime_type'				=> 'text/html',
			'size'					=> '200',
			'options'				=> json_encode(array(
				'before_body' 	=> '',
				'after_body' 	=> '',
				'before_content' => '',
				'after_content' => '',
			)),
			'title'					=> 'Home',
			'slug'					=> 'home',
			'description'			=> 'hello',
			'content'				=> 'Welcome to our website',
			'meta_keywords'			=> 'page keywords',
			'meta_description'		=> 'page descriptions',
			'created_at'			=> \Carbon\Carbon::now(),
			'updated_at'			=> \Carbon\Carbon::now(),
		);
		DB::table('posts')->insert($pages);

		/**
		* For Blog
		*/
		$blogs = array(
			'user_id'				=> 1,
			'category_id'			=> 0,
			'image'					=> null,
			'images'				=> json_encode(array()),
			'status'				=> 'publish',
			'comment_status'		=> 1,
			'type'					=> 'blog',
			'options'				=> json_encode(array(
				'before_body' 	=> '',
				'after_body' 	=> '',
				'before_content' => '',
				'after_content' => '',
			)),
			'title'					=> 'Hello Asmoyo',
			'slug'					=> 'hello-asmoyo',
			'description'			=> 'some long long long description',
			'content'				=> 'many many some long for content for this article',
			'meta_keywords'			=> 'blog keywords 1',
			'meta_description'		=> 'blogs meta description',
			'created_at'			=> \Carbon\Carbon::now(),
			'updated_at'			=> \Carbon\Carbon::now(),
		);
		DB::table('posts')->insert($blogs);

		/**
		* For Widget Banner
		*/
		$widget_banners = array(
			array(
				'category_id'	=> 3,
				'type'			=> 'widget_bootstrap-carousel',
				'order'			=> 0,
				'image'			=> 'http://lorempixel.com/920/460/',
				'title'			=> 'Some title',
				'description'	=> 'Some caption with long long long text',
			),
			array(
				'category_id'	=> 3,
				'type'			=> 'widget_bootstrap-carousel',
				'order'			=> 1,
				'image'			=> 'http://lorempixel.com/920/460/',
				'title'			=> 'Some title',
				'description'	=> 'Some caption with long long long text',
			),
		);
		DB::table('posts')->insert($widget_banners);
	}

}