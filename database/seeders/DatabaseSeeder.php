<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	$this->call([
    		//StoreTableSeeder::class,
    		// DomainTableSeeder::class,
    		// FormationTableSeeder::class,
    		// ModuleTableSeeder::class,
    		// PlanTableSeeder::class,
            //DemandeTableSeeder::class,
            FormateurTableSeeder::class,
    	]);

        // \App\Models\User::factory(10)->create();
    }
}
