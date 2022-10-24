<?php

namespace App\Http\Livewire;

use App\Models\Item;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;

class ShowItems extends Component
{
    use WithPagination;
    public $search = '';
    // protected $queryString = ['search' => ['except' => '', 'as' => 'q']];

    function updatingSearch()
    {
        $this->resetPage();
    }

    static function items($query, $paginate = 12)
    {
        return Item::with('category')->where('name', 'like', '%' . $query . '%')->paginate($paginate);
    }

    function render()
    {
        return view('livewire.show-items', ['items' => self::items($this->search)]);
    }
}
