<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactsTable extends Migration {

	public function up()
	{
		Schema::create('contacts', function(Blueprint $table) {
			$table->increments('id');
			$table->string('nom', 100)->nullable();
			$table->string('prenom', 155)->nullable();
			$table->string('object', 155)->nullable();
			$table->string('email', 255)->nullable()->unique();
			$table->string('phone', 20)->nullable()->unique();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('contacts');
	}
}