<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Demande; 
use Illuminate\Support\Str;

class DemandeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    	Demande::create([
        	'nom' => "John",
        	'prenom' => 'Joe',
        	'email' => 'john@gmail.com',
        	'phone' => '0578963487',
        	'module_id' => rand(1,4),
        ]);

        Demande::create([
        	'nom' => "Ben",
        	'prenom' => 'Aly',
        	'email' => 'aly@gmail.com',
        	'phone' => '01012568943',
        	'module_id' => rand(1,4),
        ]);

        Demande::create([
        	'nom' => "Joe",
        	'prenom' => 'Biden',
        	'email' => 'joe@gmail.com',
        	'phone' => '0876568758',
        	'module_id' => rand(1,4),
        ]);

        Demande::create([
        	'nom' => "Kouyaté",
        	'prenom' => 'Karim',
        	'email' => 'karim@gmail.com',
        	'phone' => '0278963541',
        	'module_id' => rand(1,4),
        ]);

        Demande::create([
        	'nom' => "Ben",
        	'prenom' => 'Salah',
        	'email' => 'ben@gmail.com',
        	'phone' => '0189635487',
        	'module_id' => rand(1,4),
        ]);
    }
}
