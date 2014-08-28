<?php

class PostTagTableSeeder extends Seeder {

	public function run()
	{
		DB::table('post_tag')->truncate();

		$post_tag 	= array(
			array(
				'post_id'		=> 1,
				'tag_id'		=> 1,
				'created_at'	=> \Carbon\Carbon::now(),
				'updated_at'	=> \Carbon\Carbon::now(),
			),
			array(
				'post_id'		=> 1,
				'tag_id'		=> 2,
				'created_at'	=> \Carbon\Carbon::now(),
				'updated_at'	=> \Carbon\Carbon::now(),
			),
		);

		DB::table('post_tag')->insert($post_tag);
	}

}