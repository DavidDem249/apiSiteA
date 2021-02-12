<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStoresTable extends Migration {

	public function up()
	{
		Schema::create('stores', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title', 150);
			$table->string('slug', 150)->unique();
			$table->string('image', 255);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('stores');
	}
}