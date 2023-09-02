<?php

namespace App\Livewire;

use Livewire\Component;

class Child extends Component
{
    public $text;

    public function mount($text = '')
    {
        $this->text = $text;
    }
    public function render()
    {
        return view('livewire.child');
    }

    public function goToHomePage()
    {
        return redirect('livewire-1');
    }
}
