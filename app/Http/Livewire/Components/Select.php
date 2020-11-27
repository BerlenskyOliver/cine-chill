<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class Select extends Component
{
    protected $listeners = ['changeTypeOfResult' => 'changeseletedType'];

    public array $Types = [
        'tv' => 'Tv Shows',
        'movie' => 'Movies',
        'person' => 'People',
        'keyword' => 'Keywords',
        'collection' => 'Collections',
        'company' => 'Companies'
    ];

    public string $selectedType = 'Movies';

    public function changeseletedType(string $type)
    {
        $this->selectedType  = $this->Types[$type];
    }

    public function render()
    {
        return view('livewire.components.select');
    }
}
