<?php

namespace App\Http\Livewire\Tv;

use Livewire\Component;

class Card extends Component
{
    public $tvshow;
    
    public function render()
    {
        return view('livewire.tv.card');
    }
}
