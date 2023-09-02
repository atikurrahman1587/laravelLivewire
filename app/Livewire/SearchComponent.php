<?php

namespace App\Livewire;

use Livewire\Component;

class SearchComponent extends Component
{
    public $searchText;
    public function searchBtn()
    {
        $this->dispatch('searchBtnWasClicked');
    }
    public function render()
    {
        return view('livewire.search-component');
    }
}
