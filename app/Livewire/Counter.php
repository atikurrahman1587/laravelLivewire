<?php

namespace App\Livewire;

use Livewire\Component;

class Counter extends Component
{
    public $counter = 0;
    protected $listeners = ['searchBtnWasClicked'];
    public function render()
    {
        return view('livewire.counter');
    }

    public function searchBtnWasClicked()
    {
        $this->counter++;
    }
}
