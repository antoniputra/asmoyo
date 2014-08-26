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

		// $this->call('FirstSeeder');
		$this->call('OptionsTableSeeder');
		/*$this->call('PageTableSeeder');
		$this->call('MediaTableSeeder');
		$this->call('GalleryTableSeeder');
		$this->call('UserTableSeeder');
		$this->call('PostTableSeeder');
		$this->call('CommentTableSeeder');
		$this->call('WidgetTableSeeder');*/
	}

}
