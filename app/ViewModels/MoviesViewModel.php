<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class MoviesViewModel extends ViewModel
{
    public $popularmovies;
    public $now_playingmovies;
    public $genres;

    public function __construct($popularmovies, $now_playingmovies, $genres)
    {
        $this->popularmovies = $popularmovies;
        $this->now_playingmovies = $now_playingmovies;
        $this->genres = $genres;
    }

    public function popularmovies()
    {
        return $this->formatmovies($this->popularmovies);
    }

    public function now_playingmovies()
    {
        return $this->formatmovies($this->now_playingmovies);
    }

    public function genres()
    {
        return  collect($this->genres)->mapWithKeys(function ($genre){
            return [$genre['id'] => $genre['name']];
        });

    }

    private function formatmovies($movies)
    {
        return collect($movies)->map(function($movie) {
            $genresFormatted = collect($movie['genre_ids'])->mapWithKeys(function ($value) {
                return [$value => $this->genres()->get($value)];
            })->take(3)->implode(', ');

            return collect($movie)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500'. $movie['poster_path'],
                'vote_average' => ($movie['vote_average'] * 10) .'%',
                'release_date' => Carbon::parse($movie['release_date'])->format('d M Y'),
                'genres' => $genresFormatted
            ]);
        });
    }
}