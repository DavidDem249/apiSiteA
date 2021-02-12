<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Formation;
use Illuminate\Support\Str;
class FormationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $title1 = "Formation One";
    	$title2 = "Formation Two";
    	$title3 = "Formation three";
    	$title4 = "Formation four";

        Formation::create([
        	'title' => $title1,
        	'slug' => Str::slug($title1),
        	'image' => 'https://picsum.photos/seed/picsum/200/300',
        	'domain_id' => rand(1,4),
        ]);

        Formation::create([
        	'title' => $title2,
        	'slug' => Str::slug($title2),
        	'image' => 'https://picsum.photos/200/300.webp',
        	'domain_id' => rand(1,4),
        ]);

        Formation::create([
        	'title' => $title3,
        	'slug' => Str::slug($title3),
        	'image' => 'https://picsum.photos/seed/picsum/200/300',
        	'domain_id' => rand(1,4),
        ]);

        Formation::create([
        	'title' => $title4,
        	'slug' => Str::slug($title4),
        	'image' => 'https://picsum.photos/200/300.webp',
        	'domain_id' => rand(1,4),
        ]);

    }
}
