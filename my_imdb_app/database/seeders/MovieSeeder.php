<?php

namespace Database\Seeders;

use App\Models\Director;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Furhter addition of initial movies and directors table
        // Each should fetch information from the TMDB API

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
