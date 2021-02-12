<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlansTable extends Migration {

	public function up()
	{
		Schema::create('plans', function(Blueprint $table) {
			$table->increments('id');
			$table->longText('content');
			$table->integer('module_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('plans');
	}
}