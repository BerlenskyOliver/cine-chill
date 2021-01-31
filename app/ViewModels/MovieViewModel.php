<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class MovieViewModel extends ViewModel
{
    public array $movie;
    public array $similar;

    public function __construct(array $movie, array $similar)
    {
        $this->movie = $movie;
        $this->similar = $similar;
    }

    public function  movie()
    {
        return collect($this->movie)->merge([
            'poster_path' => 'https://image.tmdb.org/t/p/w500'. $this->movie['poster_path'],
            'vote_average' => ($this->movie['vote_average'] * 10) .'%',
            'release_date' => Carbon::parse($this->movie['release_date'])->format('M d, Y'),
            'genres' => collect($this->movie['genres'])->pluck('name')->take(3)->flatten()->implode(', '),
            'crew' => collect($this->movie['credits']['crew'])->take(3),
            'cast' => collect($this->movie['credits']['cast'])->take(5),
            'images' => collect($this->movie['images']['posters'])
                        ->merge(collect($this->movie['images']['backdrops']))
                        ->take(10)
        ]);
    }

    public function similar()
    {
        return collect($this->similar)->map(function($similar) {
            return collect($similar)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500'. $similar['poster_path'],
                'vote_average' => ($similar['vote_average'] * 10) .'%',
                'release_date' => Carbon::parse($similar['release_date'])->format('d M Y'),
                'genres' => []
            ]);
        })->take(5);
    }

}
