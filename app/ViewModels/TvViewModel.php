<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvViewModel extends ViewModel
{
    public function __construct($populartv, $topratedtv, $genres)
    {
        $this->populartv = $populartv;
        $this->topratedtv = $topratedtv;
        $this->genres = $genres;
    }

    
    public function populartv()
    {
        return $this->formatmovies($this->populartv);
    }

    public function topratedtv()
    {
        return $this->formatmovies($this->topratedtv);
    }

    public function genres()
    {
        return  collect($this->genres)->mapWithKeys(function ($genre){
            return [$genre['id'] => $genre['name']];
        });

    }

    private function formatmovies($tv)
    {
        return collect($tv)->map(function($tvshow) {
            $genresFormatted = collect($tvshow['genre_ids'])->mapWithKeys(function ($value) {
                return [$value => $this->genres()->get($value)];
            })->implode(', ');

            return collect($tvshow)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500'. $tvshow['poster_path'],
                'vote_average' => ($tvshow['vote_average'] * 10) .'%',
                'first_air_date' => Carbon::parse($tvshow['first_air_date'])->format('d M Y'),
                'genres' => $genresFormatted
            ]);
        });
    }
}
