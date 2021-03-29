<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnoncesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annonces', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('entreprise')->nullable();
            $table->string('phone')->nullable();
            $table->string('duration')->nullable();
            $table->string('marge_salaire')->nullable();
            //$table->text('description_profil');
            $table->text('description_dossier')->nullable();
            $table->string('image')->nullable();
            $table->string('localisation')->nullable();
            $table->string('email')->nullable();
            $table->string('date')->nullable();
            $table->string('contrat_type')->nullable();
            $table->string('marge_salarial')->nullable();
            $table->text('description_annonce')->nullable();
            $table->string('type_travail')->nullable();

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
        Schema::dropIfExists('annonces');
    }
}
