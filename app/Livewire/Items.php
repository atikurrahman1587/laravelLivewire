<?php

namespace App\Livewire;

use App\Models\Item;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Items extends Component
{
    use WithPagination;
    public $active = false;
    public $q = '';
    public $sortBy = 'id';
    public $sortAsc = true;
    public $id;
    #[Rule('required|string|min:4')]
    public $name;
    #[Rule('required|numeric|between:1,100')]
    public $price;
    #[Rule('boolean')]
    public $status;
    public $confirmingItemDeletion = false;
    public $confirmingItemAdd = false;
    public $confirmingItemEdit = false;
    protected $queryString = [
        'active' => ['except' => false],
        'q' => ['except' => ''],
        'sortBy' => ['except' => 'id'],
        'sortAsc' => ['except' => true],
    ];

    public function render()
    {
        $items = Item::query()->where('user_id', '=', Auth::id())
            ->when($this->q, function ($query){
                return $query->where(function ($query){
                    return $query->where('name', 'like', $this->q)
                        ->orWhere('price', 'like', $this->q);
                });
            })
            ->when($this->active, function ($query){
                return $query->active();
            })
            ->orderBy($this->sortBy, $this->sortAsc ? 'ASC': 'DESC');
        //$query = $items->toSql();
        $items = $items->paginate(10);
        return view('livewire.items',[
            'items' => $items,
            //'query' => $query,
        ]);
    }
    public function updatingActive()
    {
        $this->resetPage();
    }
    public function updatingQ()
    {
        $this->resetPage();
    }

    public function getSortBy($value)
    {
        if ($value == $this->sortBy){
            $this->sortAsc = !$this->sortAsc;
        }
        $this->sortBy = $value;
    }

    public function confirmItemDeletion($id)
    {
        $this->confirmingItemDeletion = $id;
    }

    public function deleteItem(Item $item)
    {
        $item->delete();
        $this->confirmingItemDeletion = false;
        session()->flash('message', 'Item Deleted Successfully');
    }

    public function confirmItemAdd()
    {
        $this->reset(['name', 'price', 'status']);
        $this->confirmingItemAdd = true;
    }
    public function confirmItemEdit(Item $item)
    {
        $this->reset(['name', 'price', 'status']);
        $this->id = $item->id;
        $this->name = $item->name;
        $this->price = $item->price;
        $this->status = $item->status;
        $this->confirmingItemAdd = true;
    }

    public function saveItem()
    {
        $this->validate();
        if (isset($this->id)){
            Item::updateItem($this->all(), $this->id);
            session()->flash('message', 'Item Updated Successfully');
        }else{
            Item::newItem($this->all());
            session()->flash('message', 'Item Added Successfully');
        }
        $this->confirmingItemAdd = false;
    }
}
