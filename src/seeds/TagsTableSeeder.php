<?php

class TagsTableSeeder extends Seeder {

	public function run()
	{
		DB::table('tags')->truncate();

		$tags 	= array(
			array(
				'image'			=> null,
				'images'		=> json_encode(array()),
				'status'		=> 'publish',
				'title'			=> 'Tips and Trick',
				'slug'			=> 'tips-and-trick',
				'description'	=> 'ini adalah tag tips dan trick',
				'created_at'	=> \Carbon\Carbon::now(),
				'updated_at'	=> \Carbon\Carbon::now(),
			),
			array(
				'image'			=> null,
				'images'		=> json_encode(array()),
				'status'		=> 'publish',
				'title'			=> 'Awesome',
				'slug'			=> 'awesome',
				'description'	=> 'ini adalah tag awesome',
				'created_at'	=> \Carbon\Carbon::now(),
				'updated_at'	=> \Carbon\Carbon::now(),
			),
		);

		DB::table('tags')->insert($tags);
	}

}