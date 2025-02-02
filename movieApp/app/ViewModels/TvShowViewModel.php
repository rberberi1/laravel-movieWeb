<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvShowViewModel extends ViewModel
{
    public $tvshow;

    public function __construct($tvshow)
    {
        $this->tvshow = $tvshow;
    }


    public function tvshow(){
        return collect($this->tvshow)->merge([
            'poster_path'=>'https://image.tmdb.org/t/p/w500'.$this->tvshow['poster_path'],
            'vote_average'=>$this->tvshow['vote_average'] * 10 .'%',
            'first_air_date'=>Carbon::parse($this->tvshow['first_air_date'])->format('M d, Y'),
            'genres'=>collect($this->tvshow['genres'])->pluck('name')->flatten()->implode(', '),
            'crew'=> collect($this->tvshow['credits']['crew'])->take(4),
            'cast'=> collect($this->tvshow['credits']['cast'])->take(5),
        ])->only([
            'poster_path', 'id', 'name', 'vote_average', 'overview', 'first_air_date', 'genres',
            'credits', 'videos', 'crew', 'cast', 'created_by'
        ]);
    }
}
