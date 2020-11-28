<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SingleResult extends Component
{
    public $result;
    public $url;

    public function mount($result)
    {
        $this->result = $result;
        $this->url = ($result['type'] === 'tv' || $result['type'] === 'movie') ? route("{$result['type']}.show", $result['id']) :"#";
    }

    public function render()
    {
        return view('livewire.single-result');
    }
}
