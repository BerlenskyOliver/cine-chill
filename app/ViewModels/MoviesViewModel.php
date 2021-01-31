<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class MoviesViewModel extends ViewModel
{
    public ?array $popularmovies;
    public ?array $now_playingmovies;
    public ?array $genres;
    public ?array $movies_with_genre;

    public function __construct(
        ?array $popularmovies, 
        ?array $now_playingmovies, 
        ?array $genres,
        ?array $movies_with_genre)
    {
        $this->popularmovies = $popularmovies;
        $this->now_playingmovies = $now_playingmovies;
        $this->genres = $genres;
        $this->movies_with_genre = $movies_with_genre;
    }

    public function movies_with_genre()
    {
        if($this->movies_with_genre){
            return $this->formatmovies($this->movies_with_genre);
        }else{
            return [];
        }
    }
    
    public function popularmovies()
    {
        if($this->popularmovies){
            return $this->formatmovies($this->popularmovies);
        }else{
            return [];
        }
        
    }

    public function now_playingmovies()
    {
        if($this->now_playingmovies){
            return $this->formatmovies($this->now_playingmovies);
        }else{
            return [];
        }
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
            })->take(3);

            return collect($movie)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500'. $movie['poster_path'],
                'vote_average' => ($movie['vote_average'] * 10) .'%',
                'release_date' => Carbon::parse($movie['release_date'])->format('d M Y'),
                'genres' => $genresFormatted
            ]);
        });
    }
}