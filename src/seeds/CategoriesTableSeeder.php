<?php

class CategoriesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('categories')->truncate();

		$categories 	= array(
			array(
				'photo'			=> null,
				'photos'		=> json_encode(array()),
				'parent_id'		=> 0,
				'status'		=> 'publish',
				'title'			=> 'Skills',
				'slug'			=> 'skills',
				'description'	=> 'this category contain skill topic',
				'created_at'	=> \Carbon\Carbon::now(),
				'updated_at'	=> \Carbon\Carbon::now(),
			),
			array(
				'photo'			=> null,
				'photos'		=> json_encode(array()),
				'parent_id'		=> 0,
				'status'		=> 'publish',
				'title'			=> 'Knowledge',
				'slug'			=> 'knowledge',
				'description'	=> 'this category contain knowledge topic',
				'created_at'	=> \Carbon\Carbon::now(),
				'updated_at'	=> \Carbon\Carbon::now(),
			),
		);

		DB::table('categories')->insert($categories);
	}

}