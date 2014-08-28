<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('post_id');
			$table->integer('parent_id');
			$table->integer('user_id')->nullable();
		    $table->string('status');
			$table->string('title');
		    $table->text('content');
		    $table->string('anonymous_name');
		    $table->string('anonymous_email');
		    $table->string('anonymous_url');
		    $table->text('anonymous_agent');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('comments');
	}

}
