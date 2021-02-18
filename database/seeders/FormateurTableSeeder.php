<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Formateur;

class FormateurTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        Formateur::create([
        	'nom' => "John",
        	'prenom' => 'Joe',
        	'phone' => '0578963487',
        	'email' => 'john1@gmail.com',
        	'lien_linkdin' => 'linkdin2511.com',
        	'domaine' => "Développement mobile",
        ]);

        Formateur::create([
        	'nom' => "John",
        	'prenom' => 'Joe',
        	'phone' => '0578963487',
        	'email' => 'john2@gmail.com',
        	'lien_linkdin' => 'linkdin2511.com',
        	'domaine' => "Développement mobile",
        ]);

        Formateur::create([
        	'nom' => "John",
        	'prenom' => 'Joe',
        	'phone' => '0578963487',
        	'email' => 'john3@gmail.com',
        	'lien_linkdin' => 'linkdin2511.com',
        	'domaine' => "Développement mobile",
        ]);

        Formateur::create([
        	'nom' => "John",
        	'prenom' => 'Joe',
        	'phone' => '0578963487',
        	'email' => 'john4@gmail.com',
        	'lien_linkdin' => 'linkdin2511.com',
        	'domaine' => "Développement mobile",
        ]);

        Formateur::create([
        	'nom' => "John",
        	'prenom' => 'Joe',
        	'phone' => '0578963487',
        	'email' => 'john5@gmail.com',
        	'lien_linkdin' => 'linkdin2511.com',
        	'domaine' => "Développement mobile",
        ]);

    }
}
