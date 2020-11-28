<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Livewire\Component;


class SearchDropdown extends Component
{
    public $q = ''; 
    public $dropOpen = false;

    protected $queryString = [
        'q' => ['except' => '']
    ];

    public function render()
    {
        $searchResults = [];

        if(strlen($this->q) >= 2){
            $searchResults = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/search/movie?query='.$this->q)
            ->json()['results'];
        }

        return view('livewire.search-dropdown', [
            'searchResults' => collect($searchResults)->take(10),
            ]);
            //$searchResults
    }
}
