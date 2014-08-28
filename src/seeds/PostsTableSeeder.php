<?php

class PostsTableSeeder extends Seeder {

	public function run()
	{
		DB::table('posts')->truncate();

		$posts 	= array(
			
			/**
			* For Media
			* Field : user_id, category_id, status, comment_status, type, mime_type, size, title, slug, description, content, meta_keywords, meta_description
			*/
			array(
				'parent_id'				=> 0,
				'user_id'				=> 1,
				'category_id'			=> 0,
				'photo_id'				=> 0,
				'status'				=> 'visible',
				'comment_status'		=> 1,
				'type'					=> 'media',
				'order'					=> 0,
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
			),

			/**
			* For Page
			* Field : user_id parent_id category_id photo_id status comment_status type order mime_type size options title slug description content meta_keywords meta_description
			*/
			array(
				'parent_id'				=> 0,
				'user_id'				=> 1,
				'category_id'			=> 1,
				'photo_id'				=> 0,
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
			),

			/**
			* For Thread
			* Field : user_id category_id photo_id status comment_status type mime_type size options title slug description content meta_keywords meta_description
			*/
			array(
				'parent_id'				=> 0,
				'user_id'				=> 1,
				'category_id'			=> 0,
				'photo_id'				=> 0,
				'status'				=> 'publish',
				'comment_status'		=> 1,
				'type'					=> 'thread',
				'order'					=> 0,
				'mime_type'				=> 'text/html',
				'size'					=> 200,
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
				'meta_keywords'			=> 'thread keywords 1',
				'meta_description'		=> 'threads meta description',
				'created_at'			=> \Carbon\Carbon::now(),
				'updated_at'			=> \Carbon\Carbon::now(),
			),
		);

		DB::table('posts')->insert($posts);
	}

}