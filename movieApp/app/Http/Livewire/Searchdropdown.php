<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Searchdropdown extends Component
{
    public $search = '';

    public function render()
    {
        $searchResults=[];

        if(strlen($this->search) >= 2 ){
        $searchResults=Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/search/movie?query='.$this->search)
            ->json()['results'];
        }

       // dd($searchResults);
        return view('livewire.searchdropdown', [
            'searchResults' =>collect($searchResults)->take(7),
        ]);
    }
}
