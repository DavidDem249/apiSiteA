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
            $table->string('title');
            $table->string('entreprise');
            $table->string('phone');
            $table->string('duration')->nullable();
            $table->string('marge_salaire')->nullable();
            $table->text('description_profil');
            $table->text('description_dossier');
            $table->string('image')->nullable();
            $table->string('localisation');
            $table->string('email');
            $table->string('date');
            $table->string('contrat_type');
            $table->string('marge_salarial')->nullable();
            $table->text('description_annonce');
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
