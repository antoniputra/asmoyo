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
			$table->integer('parent_id')->default(0);
			$table->integer('user_id');
			$table->integer('category_id')->default(0);
			$table->integer('photo_id')->default(0);
			$table->string('status');
			$table->string('comment_status')->default(1);
			$table->string('type');
			$table->integer('order')->default(0);
			$table->string('mime_type')->default('text/html');
			$table->integer('size')->default(200);
			$table->text('options')->default(null);
			$table->string('title');
			$table->string('slug');
			$table->text('description');
			$table->text('content');
			$table->text('meta_keywords')->default(null);
			$table->text('meta_description')->default(null);
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
