<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvShowViewModel extends ViewModel
{
    public array $tvshow;
    public ?array $similar;
    public string $showModal;

    public function __construct(array $tvshow, ?array $similar, string $showModal)
    {
        $this->tvshow = $tvshow;
        $this->showModal = $showModal;
        $this->similar = $similar;
    }

    public function  tvshow(){
        return collect($this->tvshow)->merge([
            'poster_path' => 'https://image.tmdb.org/t/p/w500'. $this->tvshow['poster_path'],
            'vote_average' => ($this->tvshow['vote_average'] * 10) .'%',
            'first_air_date' => Carbon::parse($this->tvshow['first_air_date'])->format('M d, Y'),
            'genres' => collect($this->tvshow['genres'])->pluck('name')->flatten()->implode(', '),
            'crew' => collect($this->tvshow['credits']['crew'])->take(2),
            'cast' => collect($this->tvshow['credits']['cast'])->take(5),
            'images' => collect($this->tvshow['images']['posters'])
                        ->merge(collect($this->tvshow['images']['backdrops']))
                        ->take(10)
        ]);
    }

    public function simalar()
    {
        
        return collect($this->similar)->map(function($similar) {
            return collect($similar)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500'. $similar['poster_path'],
                'vote_average' => ($similar['vote_average'] * 10) .'%',
                'first_air_date' => Carbon::parse($similar['first_air_date'])->format('d M Y'),
                'genres' => []
            ]);
        });
    }
}
