<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Domain;
use Illuminate\Support\Str;
class DomainTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $title1 = "Domaine One";
    	$title2 = "Domaine Two";
    	$title3 = "Domaine three";
    	$title4 = "Domaine four";

        Domain::create([
        	'title' => $title1,
        	'slug' => Str::slug($title1),
        	'image' => 'https://picsum.photos/seed/picsum/200/300',
        	'store_id' => rand(1,2),
        ]);

        Domain::create([
        	'title' => $title2,
        	'slug' => Str::slug($title2),
        	'image' => 'https://picsum.photos/200/300.webp',
        	'store_id' => rand(1,2),
        ]);

        Domain::create([
        	'title' => $title3,
        	'slug' => Str::slug($title3),
        	'image' => 'https://picsum.photos/seed/picsum/200/300',
        	'store_id' => rand(1,2),
        ]);

        Domain::create([
        	'title' => $title4,
        	'slug' => Str::slug($title4),
        	'image' => 'https://picsum.photos/200/300.webp',
        	'store_id' => rand(1,2),
        ]);

    }
}
