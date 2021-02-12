<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFormationsTable extends Migration {

	public function up()
	{
		Schema::create('formations', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title', 150);
			$table->string('slug', 150)->unique();
			$table->string('image', 255);
			$table->integer('domain_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('formations');
	}
}