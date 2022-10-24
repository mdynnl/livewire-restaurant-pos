<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class ShowOrders extends Component
{
    use WithPagination;
    public $search = '';
    public OrderStatus $status = OrderStatus::Ongoing;
    function mount()
    {
        $this->order_status_cases = collect(OrderStatus::cases())->map->value;
    }

    function setStatus($status)
    {
        $this->status = OrderStatus::from($status);
    }


    function updatingSearch()
    {
        $this->resetPage();
    }

    function deleteOrder($id)
    {
        $o = Order::find($id);
        $o && $o->delete();
    }
    function getOrders()
    {
        $o = Order::where('id', 'like', '%' . $this->search . '%')->where('status', $this->status);

        return $o->paginate(20);
    }

    function render()
    {
        return view('livewire.show-orders')->with([
            'orders' => $this->getOrders(),
        ]);
    }
}
