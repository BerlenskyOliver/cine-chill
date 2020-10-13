<?php

namespace App\Http\Livewire\Movie;

use Livewire\Component;

class Card extends Component
{
    public $movie;
    
    public function render()
    {
        return view('livewire.movie.card');
    }
}
