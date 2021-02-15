<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;
use Illuminate\Support\Str;

class HomeViewModel extends ViewModel
{
    public array $popularmovies;
    public array $popularseries;
    private array $moviegenres;
    private array $seriegenres;
    public array $netflixoriginal;
    public array $upcomingmovies;
    public array $ontheairseries;

    public function __construct(
        array $popularmovies, 
        array $popularseries, 
        array $moviegenres,
        array $seriegenres,
        array $netflixoriginal,
        array $upcomingmovies,
        array $ontheairseries
    )
    {
        $this->popularmovies = $popularmovies;
        $this->popularseries = $popularseries;
        $this->moviegenres = $moviegenres;
        $this->seriegenres = $seriegenres;
        $this->netflixoriginal = $netflixoriginal;
        $this->upcomingmovies = $upcomingmovies;
        $this->ontheairseries = $ontheairseries;
    }
    
    public function popularmovies(): Collection
    {
        return $this->formatmovies($this->popularmovies, 'release_date', $this->moviegenres());
    }

    public function popularseries(): Collection
    {
        return $this->formatmovies($this->popularseries, 'first_air_date', $this->seriegenres());
    }

    public function ontheairseries(): Collection
    {
        return $this->formatmovies($this->ontheairseries, 'first_air_date', null);
    }

    public function upcomingmovies(): Collection
    {
        return $this->formatmovies($this->upcomingmovies, 'release_date', null);
    }

    private function moviegenres(): Collection
    {
        return  collect($this->moviegenres)->mapWithKeys(function ($genre){
            return [$genre['id'] => $genre['name']];
        });
    }

    public function netflixoriginal(): Collection
    {
        return collect($this->netflixoriginal)->merge([
            'backdrop_path' => 'https://image.tmdb.org/t/p/original'.$this->netflixoriginal['backdrop_path'],
            'overview' => Str::limit($this->netflixoriginal['overview'], 150)
        ]);
    }

    private function seriegenres(): Collection
    {
        return  collect($this->seriegenres)->mapWithKeys(function ($genre){
            return [$genre['id'] => $genre['name']];
        });
    }

    private function formatmovies(array $movies,string $date, ?Collection $genres): Collection
    {
        return collect($movies)->map(function($movie) use($date, $genres) {

            $genresFormatted = $genres ? collect($movie['genre_ids'])->mapWithKeys(function ($value) use ($genres) {
                return [$value => $genres->get($value)];
            })->take(3) : []; 

            return collect($movie)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500'. $movie['poster_path'],
                'vote_average' => ($movie['vote_average'] * 10) .'%',
                $date => Carbon::parse($movie[$date])->format('d M Y'),
                'genres' => $genresFormatted
            ]);
        });
    }

}
