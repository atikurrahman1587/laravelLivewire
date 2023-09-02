<?php

namespace App\Livewire;

use Livewire\Component;

class FirstComponent extends Component
{
    public $buttonText;
    public function render()
    {
        $this->buttonText = 'Apply';
        return view('livewire.first-component');
    }
}
