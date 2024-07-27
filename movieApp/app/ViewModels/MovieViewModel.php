<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use Carbon\Carbon;

class MovieViewModel extends ViewModel
{
    public $movie;

    public function __construct($movie)
    {
        $this->movie = $movie;
    }


    public function movie(){
        return collect($this->movie)->merge([
            'poster_path'=>'https://image.tmdb.org/t/p/w500'.$this->movie['poster_path'],
            'vote_average'=>$this->movie['vote_average'] * 10 .'%',
            'release_date'=>Carbon::parse($this->movie['release_date'])->format('M d, Y'),
            'genres'=>collect($this->movie['genres'])->pluck('name')->flatten()->implode(', '),
            'crew'=> collect($this->movie['credits']['crew'])->take(4),
            'cast'=> collect($this->movie['credits']['cast'])->take(5),
        ])->only([
            'poster_path', 'id', 'title', 'vote_average', 'overview', 'release_date', 'genres',
            'credits', 'videos', 'crew', 'cast',
        ]);
    }


}
