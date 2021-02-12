<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Module;
use Illuminate\Support\Str;

class ModuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        $title1 = "Module One";
    	$title2 = "Module Two";
    	$title3 = "Module three";
    	$title4 = "Module four";

        Module::create([
        	'title' => $title1,
        	'slug' => Str::slug($title1),
        	'image' => 'https://picsum.photos/seed/picsum/200/300',
        	'formation_id' => rand(1,4),
        	'stat' => 'Débutant',
        	'duration' => '1 Mois',
        ]);

        Module::create([
        	'title' => $title2,
        	'slug' => Str::slug($title2),
        	'image' => 'https://picsum.photos/200/300.webp',
        	'formation_id' => rand(1,4),
        	'stat' => 'Intermediaire',
        	'duration' => '7 Mois',
        ]);

        Module::create([
        	'title' => $title3,
        	'slug' => Str::slug($title3),
        	'image' => 'https://picsum.photos/seed/picsum/200/300',
        	'formation_id' => rand(1,4),
        	'stat' => 'Avancé',
        	'duration' => '1 an',
        ]);

        Module::create([
        	'title' => $title4,
        	'slug' => Str::slug($title4),
        	'image' => 'https://picsum.photos/200/300.webp',
        	'formation_id' => rand(1,4),
        	'stat' => 'Débutant',
        	'duration' => '4 h',
        ]);


    }
}
