<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('parent_id');
			$table->integer('user_id');
			$table->integer('category_id');
			$table->integer('photo_id');
			$table->string('status');
			$table->string('comment_status');
			$table->string('type');
			$table->integer('order');
			$table->string('mime_type');
			$table->integer('size');
			$table->text('options');
			$table->string('title');
			$table->string('slug');
			$table->text('description');
			$table->text('body');
			$table->text('meta_keywords');
			$table->text('meta_description');
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
		Schema::drop('posts');
	}

}
