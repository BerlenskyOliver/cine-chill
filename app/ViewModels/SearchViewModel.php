<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Spatie\ViewModels\ViewModel;


class SearchViewModel extends ViewModel
{
    public array $search;
    public array $searchResults;
    public string $type;

    public function __construct($search, $type)
    {
        $this->search = $search;
        $this->type = $type;
        $this->searchResults = $this->formatSearch($this->search);
    }

    public function searchResults()
    {
        return $this->formatSearch($this->search);
    }

    private function formatSearch($results)
    {
        return collect($results)->map(function($result)
        {
            if($this->type === 'movie'){
                if($result['poster_path'] === null ) return;

                return collect($result)->merge([
                    'name' => $result['title'],
                    'poster_path' => 'https://image.tmdb.org/t/p/w500'. $result['poster_path'],
                    'vote_average' => ($result['vote_average'] * 10) .'%',
                    'publish_date' => Carbon::parse($result['release_date'])->format('d M Y'),
                    'type' => $this->type
                ]);
            }elseif($this->type === 'person'){
                if($result['profile_path'] === null) return;

                return collect($result)->merge([
                    'name' => $result['name'],
                    'poster_path' => 'https://image.tmdb.org/t/p/w235_and_h235_face/'. $result['profile_path'],
                    'type' => $this->type
                ]);
            }elseif($this->type === 'collection'){
                if($result['poster_path'] === null) return;

                return collect($result)->merge([
                    'name' => $result['name'],
                    'poster_path' => 'https://image.tmdb.org/t/p/w500'. $result['poster_path'],
                    'type' => $this->type
                ]);
            }elseif($this->type === 'keyword'){
                return collect($result)->merge([
                    'name' => $result['name'],
                    'type' => $this->type
                ]);
            }elseif($this->type === 'company'){
                if($result['logo_path'] === null) return;

                return collect($result)->merge([
                    'name' => $result['name'],
                    'poster_path' => 'https://image.tmdb.org/t/p/w500'. $result['logo_path'],
                    'type' => $this->type
                ]);
            }
            else{
                if($result['poster_path'] === null ) return;

                return collect($result)->merge([
                    'name' => $result['name'],
                    'poster_path' => 'https://image.tmdb.org/t/p/w500'. $result['poster_path'],
                    'vote_average' => ($result['vote_average'] * 10) .'%',
                    'publish_date' => Carbon::parse($result['first_air_date'])->format('d M Y'),
                    'type' => $this->type
                ]);
            }
            
        })->toArray();
    }
}
