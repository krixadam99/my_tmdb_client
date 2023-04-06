<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Director;
use App\Models\Genre;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $token = 'eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIyYTM2ODVkNTU5ZGMwZWNmNDYyNWRmNTc1MmJlOGZkYyIsInN1YiI6IjY0MmU4NzAzYzlkYmY5MDBkNTBjZmI2NiIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.8_yxcR6sHOfEfbzzi4djWG6d0GSpv6pc01bm8fQ-Woo';

        $top_rated_movies = [];
        $genres = Http::withToken($token)->get('https://api.themoviedb.org/3/genre/movie/list'
        )->json()['genres'];
        for($i=1; $i < 7; $i++){
            $results_per_age = Http::withToken($token)->get('https://api.themoviedb.org/3/movie/top_rated', [
                'page' => $i,
            ])->json()["results"];
            foreach($results_per_age as $movie){
                $genre_ids = $movie['genre_ids'];
                foreach($genre_ids as $genre_id){
                    foreach($genres as $genre){
                        if($genre['id'] == $genre_id){
                            $movie["genre_names"] []= $genre['name'];
                        }
                    }
                }

                $movie_details_and_credits = Http::withToken($token)->get('https://api.themoviedb.org/3/movie/' . $movie['id'] . '?append_to_response=credits')->json();
                $movie_crew = $movie_details_and_credits['credits']['crew'];
                $movie["directors"] = [];
                $director_names = [];
                $movie['length'] = $movie_details_and_credits['runtime'];
                foreach($movie_crew as $member){
                    if($member['known_for_department'] === 'Directing'){
                        $director_id = $member['id'];
                        $director_name = $member['name'];
                        if(!in_array($director_name, $director_names)){
                            // The execution time is incredibly extended if we want to fetch the directors' details
                            $director_details = Http::withToken($token)->get('https://api.themoviedb.org/3/person/' . $director_id)->json();
                            $director_biography = $director_details['biography'];
                            $director_birthday = $director_details['birthday'];



                            $movie["directors"] []= [
                                "id" => $director_id,
                                "name" => $director_name,
                                "biography" => $director_biography,
                                "birthday" => $director_birthday
                            ];
                            $director_names []= $director_name;
                        }

                    }
                }
                $top_rated_movies []= $movie;
            }
        }
        //dd($top_rated_movies);

        return view('movies', ['movies' => $top_rated_movies]);
    }
}
