<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Http;

class ViewMoviesTest extends TestCase
{

    public function the_main_page_shows_correct_info()
    {
        Http::fake([
            'https://api.themoviedb.org/3/movie/popular' =>$this->fakePopularMovies(),
            'https://api.themoviedb.org/3/movie/now_playing' =>$this->fakeNowPlayingMovies(),
            'https://api.themoviedb.org/3/genre/movie/list' =>$this->fakeGenres(),
        ]);

        $response = $this->get(route('index'));

        $response->assertSuccessful();
        $response->assertSee('Popular Movies');
        $response->assertSee('Fake Movie');
        $response->assertSee('Action, Family, Adventure, Comedy');
        $response->assertSee('Now Playing');
        $response->assertSee('Fake Now Playing Movie');
    }


    private function fakePopularMovies(){
        return Http::response([
            'results' => [
                [
                    "adult" => false,
                    "backdrop_path" => "/xg27NrXi7VXCGUr7MG75UqLl6Vg.jpg",
                    "genre_ids" =>  [
                      28,
                      10751,
                      12,
                      35,
                    ],
                    "id" => 1022789,
                    "original_language" => "en",
                    "original_title" => "Fake Movie",
                    "overview" => "Teenager Riley's mind headquarters is undergoing a sudden demolition to make room for something entirely unexpected: new Emotions! Joy, Sadness, Anger, Fear and ",
                    "popularity" => 6082.896,
                    "poster_path" => "/vpnVM9B6NMmQpWeZvzLvDESb2QY.jpg",
                    "release_date" => "2024-06-11",
                    "title" => "Fake Movie",
                    "video" => false,
                    "vote_average" => 7.649,
                    "vote_count" => 1994,
                ]
            ]
        ], 200);
    }

    private function fakeNowPlayingMovies(){
        return Http::response([
            'results' => [
                [
                    "adult" => false,
                    "backdrop_path" => "/xg27NrXi7VXCGUr7MG75UqLl6Vg.jpg",
                    "genre_ids" =>  [
                      28,
                      10751,
                      12,
                      35,
                    ],
                    "id" => 1022789,
                    "original_language" => "en",
                    "original_title" => "Fake Now Playing Movie",
                    "overview" => "Teenager Riley's mind headquarters is undergoing a sudden demolition to make room for something entirely unexpected: new Emotions! Joy, Sadness, Anger, Fear and ",
                    "popularity" => 6082.896,
                    "poster_path" => "/vpnVM9B6NMmQpWeZvzLvDESb2QY.jpg",
                    "release_date" => "2024-06-11",
                    "title" => "Fake Now Playing Movie",
                    "video" => false,
                    "vote_average" => 7.649,
                    "vote_count" => 1994,
                ]
            ]
        ], 200);
    }

    private function fakeGenres(){
        return Http::response([
            'genres'=>[
                28 => "Action",
                12 => "Adventure",
                16 => "Animation",
                35 => "Comedy",
                80 => "Crime",
                99 => "Documentary",
                18 => "Drama",
                10751 => "Family",
                14 => "Fantasy",
                36 => "History",
                27 => "Horror",
                10402 => "Music",
                9648 => "Mystery",
                10749 => "Romance",
                878 => "Science Fiction",
                10770 => "TV Movie",
                53 => "Thriller",
                10752 => "War",
                37 => "Western",
            ]
            ]);
    }
}
