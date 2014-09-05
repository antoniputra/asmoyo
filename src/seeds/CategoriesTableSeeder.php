<?php

class CategoriesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('categories')->truncate();

		$categories 	= array(
			array(
				'image'			=> null,
				'images'		=> json_encode(array()),
				'type'			=> 'category',
				'parent_id'		=> 0,
				'status'		=> 'publish',
				'title'			=> 'Skills',
				'slug'			=> 'skills',
				'description'	=> 'this category contain skill topic',
				'options'		=> json_encode(array()),
				'created_at'	=> \Carbon\Carbon::now(),
				'updated_at'	=> \Carbon\Carbon::now(),
			),
			array(
				'image'			=> null,
				'images'		=> json_encode(array()),
				'type'			=> 'category',
				'parent_id'		=> 0,
				'status'		=> 'publish',
				'title'			=> 'Knowledge',
				'slug'			=> 'knowledge',
				'description'	=> 'this category contain knowledge topic',
				'options'		=> json_encode(array()),
				'created_at'	=> \Carbon\Carbon::now(),
				'updated_at'	=> \Carbon\Carbon::now(),
			),

			array(
				'image'			=> null,
				'images'		=> json_encode(array()),
				'type'			=> 'preference_banner',
				'parent_id'		=> 0,
				'status'		=> 'publish',
				'title'			=> 'Banner Utama',
				'slug'			=> 'banner-utama',
				'description'	=> 'this banner for main page',
				'options'		=> json_encode(array()),
				'created_at'	=> \Carbon\Carbon::now(),
				'updated_at'	=> \Carbon\Carbon::now(),
			),
		);

		DB::table('categories')->insert($categories);
	}

}