<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Store;
use Illuminate\Support\Str;

class StoreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
    */
    public function run()
    {
    	$title1 = "Store Three";
    	$title2 = "Store Four";

        Store::create([
        	'title' => $title1,
        	'slug' => Str::slug($title1),
        	'image' => 'https://picsum.photos/seed/picsum/200/300',
        ]);

        Store::create([
        	'title' => $title2,
        	'slug' => Str::slug($title2),
        	'image' => 'https://picsum.photos/200/300.webp',
        ]);

    }
}
