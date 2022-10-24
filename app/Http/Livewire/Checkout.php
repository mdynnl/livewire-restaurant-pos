<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\OrderStatus;
use Livewire\Component;

class Checkout extends Component
{
    function mount(Order $order)
    {
        $this->order = $order;
    }
    function confirm()
    {
        $this->order->status = OrderStatus::Paid;
        $this->order->save();
    }
    public function render()
    {
        return view('livewire.checkout');
    }
}
