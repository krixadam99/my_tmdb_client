<?php

namespace Database\Seeders;

use App\Models\Director;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $directors = Director::all();
        $genres = Genre::all();

        foreach($directors as $director){
            $random_directors = $directors
                ->where('director_id', '!=', $director->id)
                ->random(2);
            $random_genres = $genres->random(2);


            Movie::factory()
                ->hasAttached($random_directors)
                ->hasAttached($random_genres)
                ->create();
        }
    }
}
