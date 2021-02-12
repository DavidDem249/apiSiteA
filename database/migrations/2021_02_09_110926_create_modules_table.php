<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateModulesTable extends Migration {

	public function up()
	{
		Schema::create('modules', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title', 155);
			$table->string('slug', 155)->unique();
			$table->string('image', 255);
			$table->string('stat', 100);
			$table->string('duration', 80)->nullable();
			$table->integer('formation_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('modules');
	}
}