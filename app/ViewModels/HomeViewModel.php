<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;
use Illuminate\Support\Str;

class HomeViewModel extends ViewModel
{
    public $popularmovies;
    public $popularseries;
    private $moviegenres;
    private $seriegenres;
    public $netflixoriginal;

    public function __construct(
        $popularmovies, 
        $popularseries, 
        $moviegenres,
        $seriegenres,
        $netflixoriginal)
    {
        $this->popularmovies = $popularmovies;
        $this->popularseries = $popularseries;
        $this->moviegenres = $moviegenres;
        $this->seriegenres = $seriegenres;
        $this->netflixoriginal = $netflixoriginal;
    }
    
    public function popularmovies()
    {
        return $this->formatmovies($this->popularmovies, 'release_date', $this->moviegenres());
    }

    public function popularseries()
    {
        return $this->formatmovies($this->popularseries, 'first_air_date', $this->seriegenres());
    }

    private function moviegenres()
    {
        return  collect($this->moviegenres)->mapWithKeys(function ($genre){
            return [$genre['id'] => $genre['name']];
        });
    }

    public function netflixoriginal()
    {
        return collect($this->netflixoriginal)->merge([
            'backdrop_path' => 'https://image.tmdb.org/t/p/original'.$this->netflixoriginal['backdrop_path'],
            'overview' => Str::limit($this->netflixoriginal['overview'], 150)
        ]);
    }

    private function seriegenres()
    {
        return  collect($this->seriegenres)->mapWithKeys(function ($genre){
            return [$genre['id'] => $genre['name']];
        });
    }

    private function formatmovies($movies, $date, $genres)
    {
        return collect($movies)->map(function($movie) use($date, $genres) {
            $genresFormatted = collect($movie['genre_ids'])->mapWithKeys(function ($value) use ($genres) {
                return [$value => $genres->get($value)];
            })->take(3);

            return collect($movie)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500'. $movie['poster_path'],
                'vote_average' => ($movie['vote_average'] * 10) .'%',
                $date => Carbon::parse($movie[$date])->format('d M Y'),
                'genres' => $genresFormatted
            ]);
        });
    }

}
