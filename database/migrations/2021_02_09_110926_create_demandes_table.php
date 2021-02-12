<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDemandesTable extends Migration {

	public function up()
	{
		Schema::create('demandes', function(Blueprint $table) {
			$table->increments('id');
			$table->string('nom', 100)->nullable();
			$table->string('prenom', 200)->nullable();
			$table->string('email', 255)->nullable()->unique();
			$table->string('phone', 20)->unique();
			$table->integer('module_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('demandes');
	}
}