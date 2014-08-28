<?php

class CommentsTableSeeder extends Seeder {

	public function run()
	{
		DB::table('comments')->truncate();

		$comments 	= array(
			array(
				'post_id'			=> 1,
				'user_id'			=> 2,
				'parent_id'			=> 0,
				'status'			=> 'waiting',
				'title'				=> 'Testing Komentar',
				'content'			=> 'Ini adalah testing komentar',
				'anonymous_name'	=> null,
				'anonymous_email'	=> null,
				'anonymous_url'		=> null,
				'anonymous_agent'	=> null,
				'created_at'		=> \Carbon\Carbon::now(),
				'updated_at'		=> \Carbon\Carbon::now(),
			),
		);

		DB::table('comments')->insert($comments);
	}

}