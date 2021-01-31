<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvViewModel extends ViewModel
{
    public function __construct(?array $populartv, ?array $topratedtv, ?array $genres, ?array $tv_with_genre)
    {
        $this->populartv = $populartv;
        $this->topratedtv = $topratedtv;
        $this->genres = $genres;
        $this->tv_with_genre = $tv_with_genre;
    }

    public function tv_with_genre()
    {
        if($this->tv_with_genre){
            return $this->formatTvShow($this->tv_with_genre);
        }else{
            return [];
        }
    }

    public function populartv()
    {
        return $this->formatTvShow($this->populartv);
    }

    public function topratedtv()
    {
        return $this->formatTvShow($this->topratedtv);
    }

    public function genres()
    {
        return  collect($this->genres)->mapWithKeys(function ($genre){
            return [$genre['id'] => $genre['name']];
        });

    }

    private function formatTvShow($tv)
    {
        return collect($tv)->map(function($tvshow) {
            $genresFormatted = collect($tvshow['genre_ids'])->mapWithKeys(function ($value) {
                return [$value => $this->genres()->get($value)];
            });

            return collect($tvshow)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500'. $tvshow['poster_path'],
                'vote_average' => ($tvshow['vote_average'] * 10) .'%',
                'first_air_date' => Carbon::parse($tvshow['first_air_date'])->format('d M Y'),
                'genres' => $genresFormatted
            ]);
        });
    }
}
