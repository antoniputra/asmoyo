<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		DB::table('users')->truncate();

		$users 	= array(
			array(
				'email'       	=> 'admin@admin.com',
				'username'     	=> 'administrator',
	            'password'    	=> Hash::make('superadmin'),
	            'permissions'	=> json_encode(array('superuser' => 1)),
	            'fullname'  	=> 'Administrator',
	            'activated'   	=> 1,
	            'birthday'		=> '1994-03-17',
	            'city'			=> 'Surabaya',
	            'address'		=> '',
	            'created_at'	=> \Carbon\Carbon::now(),
				'updated_at'	=> \Carbon\Carbon::now(),
			),
			array(
				'email'       	=> 'akiddcode@gmail.com',
				'username'     	=> 'toniput',
	            'password'    	=> Hash::make('toniput'),
	            'permissions'	=> json_encode(array()),
	            'fullname'  	=> 'Antoni Putra',
	            'activated'   	=> 1,
	            'birthday'		=> '1994-03-17',
	            'city'			=> 'Surabaya',
	            'address'		=> 'Simo Gunung Barat Tol 1 / 59',
	            'created_at'	=> \Carbon\Carbon::now(),
				'updated_at'	=> \Carbon\Carbon::now(),
			),
		);

		DB::table('users')->insert($users);
	}

}