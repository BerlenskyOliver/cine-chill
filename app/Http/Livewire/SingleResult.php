<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SingleResult extends Component
{
    public $result;

    public function mount($result)
    {
        $this->result = $result;
    }

    public function render()
    {
        return view('livewire.single-result');
    }
}
