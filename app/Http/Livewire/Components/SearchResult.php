<?php

namespace App\Http\Livewire\Components;

use App\ViewModels\SearchViewModel;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SearchResult extends Component
{
    public string $query;
    public string $type = 'movie';
   

    protected $listeners = ['changeTypeOfResult'];

    public function mount(string $query)
    {
        $this->query = $query; 
    }

    public function changeTypeOfResult(string $type)
    {
        $this->type = $type;
    }

    public function getSearchResult()
    {
        $searchResults = Http::withToken(config('services.tmdb.token'))
        ->get("https://api.themoviedb.org/3/search/{$this->type}?query={$this->query}")
        ->json()['results'];
        
        return new SearchViewModel($searchResults, $this->type);
    }

    public function render()
    {
        return view('livewire.components.search-result', [
            'results' => $this->getSearchResult()
        ]);
    }
}
