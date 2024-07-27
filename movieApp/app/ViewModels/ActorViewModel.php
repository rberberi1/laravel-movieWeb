<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use Carbon\Carbon;

class ActorViewModel extends ViewModel
{
    public $actor;
    public $social;
    public $credits;

    public function __construct($actor, $social, $credits)
    {
        $this->actor=$actor;   
        $this->social=$social;   
        $this->credits=$credits;   
    }

    public function actor(){
        return collect($this->actor)->merge([
            'birthday'=>Carbon::parse($this->actor['birthday'])->format('M d, Y'),
            'age'=>Carbon::parse($this->actor['birthday'])->age,
            'profile_path'=>$this->actor['profile_path']
            ? 'https://image.tmdb.org/t/p/w300'.$this->actor['profile_path']
            : 'https://via.placeholder.com/300x450',
            
            
        ]);
    }

    public function social(){
        return collect($this->social)->merge([
            'twitter'=> $this->social['twitter_id'] ? 'https://twitter.com/'.$this->social['twitter_id']:null,
            'facebook'=> $this->social['facebook_id'] ? 'https://facebook.com/'.$this->social['facebook_id']:null,
            'instagram'=> $this->social['instagram_id'] ? 'https://instagram.com/'.$this->social['instagram_id']:null,
        ]);
    }

    public function knownForTitles()
{
    $castTitles = collect($this->credits['cast'] ?? []);

    return $castTitles->sortByDesc('popularity')->take(5)->map(function ($movie) {
        $title = $movie['title'] ?? ($movie['name'] ?? 'Untitled');
        $posterPath = $movie['poster_path'] 
            ? 'https://image.tmdb.org/t/p/w185' . $movie['poster_path'] 
            : 'https://via.placeholder.com/185x278';
        $linkToPage = $movie['media_type'] === 'movie' 
            ? route('movies.show', $movie['id']) 
            : route('tvshow.show', $movie['id']);

        return collect($movie)->merge([
            'poster_path' => $posterPath,
            'title' => $title,
            'linkToPage' => $linkToPage,
        ])->only([
            'poster_path', 'title', 'id', 'media_type', 'linkToPage'
        ]);
    });
}




    public function credits()
    {
        $castTitles = collect($this->credits['cast'] ?? []);
    
        return $castTitles->map(function ($movie) {

            if(isset($movie['release_date'])) {
                $releaseDate=$movie['release_date'];
            }elseif (isset($movie['first_air_date'])){
                $releaseDate=$movie['first_air_date'];
            }else{
                $releaseDate='';
            }


            if(isset($movie['title'])){
                $title=$movie['title'];
            }elseif(isset($movie['name'])){
                $title=$movie['name'];
            }else{
                $title='Untitled';
            }
                return collect($movie)->merge([
                    'release_date'=>$releaseDate,
                    'release_year'=>isset($releaseDate) ? Carbon::parse($releaseDate)->format('Y') : 'Future',
                    'title'=>$title,
                    'character'=>isset($movie['character']) ? $movie['character'] : '',
                ]);
            })->sortByDesc('release_date');
    }
    
}
