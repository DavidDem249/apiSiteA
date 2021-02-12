<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('domains', function(Blueprint $table) {
			$table->foreign('store_id')->references('id')->on('stores')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('formations', function(Blueprint $table) {
			$table->foreign('domain_id')->references('id')->on('domains')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('modules', function(Blueprint $table) {
			$table->foreign('formation_id')->references('id')->on('formations')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('plans', function(Blueprint $table) {
			$table->foreign('module_id')->references('id')->on('modules')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('demandes', function(Blueprint $table) {
			$table->foreign('module_id')->references('id')->on('modules')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('domains', function(Blueprint $table) {
			$table->dropForeign('domains_domain_id_foreign');
		});
		Schema::table('formations', function(Blueprint $table) {
			$table->dropForeign('formations_domain_id_foreign');
		});
		Schema::table('modules', function(Blueprint $table) {
			$table->dropForeign('modules_formation_id_foreign');
		});
		Schema::table('plans', function(Blueprint $table) {
			$table->dropForeign('plans_module_id_foreign');
		});
		Schema::table('demandes', function(Blueprint $table) {
			$table->dropForeign('demandes_module_id_foreign');
		});
	}
}