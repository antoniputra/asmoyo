<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('email');
			$table->string('username');
			$table->string('password');
			$table->text('permissions');
			$table->tinyInteger('activated')->default(0);
			$table->string('activation_code');
			$table->timestamp('activated_at');
			$table->timestamp('last_login');
			$table->string('remember_token')->nullable();
			$table->string('persist_code');
			$table->string('reset_password_code');
			$table->string('photo');
			$table->string('fullname');
			$table->date('birthday');
			$table->enum('gender', array('male', 'female'));
			$table->string('city');
			$table->text('address');
			$table->text('location')->nullable();
			$table->text('description');
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop( 'users' );
	}

}
