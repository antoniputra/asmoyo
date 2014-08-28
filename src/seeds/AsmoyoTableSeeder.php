<?php

class AsmoyoTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// disable foreign key check for running seeder
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');

		$this->call('OptionsTableSeeder');
		$this->call('UsersTableSeeder');
		$this->call('CategoriesTableSeeder');
		$this->call('TagsTableSeeder');
		$this->call('PostsTableSeeder');
		$this->call('PostTagTableSeeder');
		$this->call('CommentsTableSeeder');
		/*$this->call('PageTableSeeder');
		$this->call('MediaTableSeeder');
		$this->call('GalleryTableSeeder');
		$this->call('UserTableSeeder');
		$this->call('PostTableSeeder');
		$this->call('CommentTableSeeder');
		$this->call('WidgetTableSeeder');*/
	}

}
