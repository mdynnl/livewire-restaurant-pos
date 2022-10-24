<?php

namespace App\Http\Livewire;

use App\Models\Table;
use Livewire\Component;

class ShowTables extends Component
{
    function render()
    {
        return view('livewire.show-tables')->with(['all' => Table::all()]);
    }
}
