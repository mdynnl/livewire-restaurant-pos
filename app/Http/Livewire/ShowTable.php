<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\Table;
use Livewire\Component;

class ShowTable extends Component
{
    protected $listeners = ['deleteOrder'];
    function mount(Table $table)
    {
        $this->table = $table;
        $this->active_orders = $table->active_orders;
    }
    function deleteOrder($id)
    {
        $index = $this->active_orders->search(fn ($o) => $o->id === $id);
        $o = $this->active_orders->pull($index); //Order::find($this->active_orders->pull($index)['order_id']);
        $o->delete();
        $this->table->refresh();
    }
    function newOrder()
    {
        $o = Order::create();
        $this->table->table_orders()->create(['order_id' => $o->id]);
        redirect(route('order', $o));
    }

    function render()
    {
        return view('livewire.show-table');
    }
}
