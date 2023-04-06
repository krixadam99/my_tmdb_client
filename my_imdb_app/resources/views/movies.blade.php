@extends('layouts.layout')

@section('title', 'Movies')

@section('content')
    <h1 class="ps-3">Movies with best rating</h1>
    <hr />
    <div class="table-responsive">
        <table class="table align-middle table-hover">
            <thead class="text-center table-light">
                <tr>
                    <th>Title</th>
                    <th>Length (in mins)</th>
                    <th>Genres</th>
                    <th>Release date</th>
                    <th>Overview</th>
                    <th>Poster URL</th>
                    <th>TMDB id</th>
                    <th>TMDB vote avg</th>
                    <th>TMDB vote count</th>
                    <th>TMDB url</th>
                    <th>Director(s)</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($movies as $movie)
                    <tr>
                        <td>
                            <div>{{ $movie['title'] }}</div>
                        </td>
                        <td>
                            <div>{{ $movie['length'] }}</div>
                        </td>
                        <td>
                            <table class="table align-middle table-hover">
                                <tbody class="text-center">
                                    @foreach ($movie['genre_names'] as $genre)
                                        <tr>
                                            <td>
                                                <div>{{ $genre }}</div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                        <td>
                            <div>{{ $movie['release_date'] }}</div>
                        </td>
                        <td>
                            <div class="elliptical_text">{{ $movie['overview'] }}</div>
                        </td>
                        <td>
                            <div>{{ $movie['poster_path'] }}</div>
                        </td>
                        <td>
                            <div>{{ $movie['id'] }}</div>
                        </td>
                        <td>
                            <div>{{ $movie['vote_average'] }}</div>
                        </td>
                        <td>
                            <div>{{ $movie['vote_count'] }}</div>
                        </td>
                        <td>
                            <div>
                                
                            </div>
                        </td>
                        <td>
                            <table class="table align-middle table-hover">
                                <tbody class="text-center">
                                    @foreach ($movie['directors'] as $director)
                                        <tr>
                                            <td>
                                                <div>{{ $director['name'] }}</div>
                                            </td>
                                            <td>
                                                <div>{{ $director['id'] }}</div>
                                            </td>
                                            <td>
                                                <div class="elliptical_text"></div>
                                            </td>
                                            <td>
                                                <div></div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
