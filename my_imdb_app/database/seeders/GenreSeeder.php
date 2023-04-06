<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $token = 'eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIyYTM2ODVkNTU5ZGMwZWNmNDYyNWRmNTc1MmJlOGZkYyIsInN1YiI6IjY0MmU4NzAzYzlkYmY5MDBkNTBjZmI2NiIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.8_yxcR6sHOfEfbzzi4djWG6d0GSpv6pc01bm8fQ-Woo';
        $genres = Http::withToken($token)->get('https://api.themoviedb.org/3/genre/movie/list'
        )->json()['genres'];

        foreach($genres as $genre){
            Genre::factory()->create([
                "genre_name" => $genre['name'],
                "genre_tmdb_id" => $genre['id'],
            ]);
        }

        //Genre::factory(15)->create();

    }
}
