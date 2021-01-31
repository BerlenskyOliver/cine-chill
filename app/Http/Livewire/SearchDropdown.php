<?php

namespace App\Http\Livewire;

use App\Http\HttpCall;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Livewire\Component;


class SearchDropdown extends Component
{
    public $q = ''; 

    protected $queryString = [
        'q' => ['except' => '']
    ];

    public function render()
    {
        $searchResults = [];

        if(strlen($this->q) >= 2){
            $searchResults = HttpCall::Tmdbget('/search/movie', "?query=$this->q")['results'];
            // Http::withToken(config('services.tmdb.token'))
            // ->get('https://api.themoviedb.org/3/search/movie?query='.$this->q)
            // ->json();

        }

        return view('livewire.search-dropdown', [
            'searchResults' => collect($searchResults)->take(10),
            ]);
    }
}
