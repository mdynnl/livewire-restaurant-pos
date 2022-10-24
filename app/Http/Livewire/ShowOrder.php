<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\TableOrderItem;
use Livewire\Component;

class ShowOrder extends Component
{
    protected $listeners = ['clickItem'];
    function mount(Order $order, ?int $table = null)
    {
        if ($order->status === OrderStatus::Paid) {
            redirect(route('checkout', $order));
        }

        $this->table_id = $table;
        $this->order = $order;
        $this->table_order = $this->table_id ? $this->order->table_orders()->whereHas('table', fn ($t) => $t->where('id', $this->table_id))->first() : $this->order->table_orders->first();
        $this->table = $this->table_order->table;
    }

    function updatingTableId($table) {
        $this->mount($this->order, $table);
    }

    function clickItem(Item $item)
    {
        $order_item = $this->table_order->order_items()->firstOrNew(['item_id' => $item->id]);
        $this->updateQty($order_item);
    }

    function updateQty($order_item, $qty = 1)
    {
        if (is_int($order_item)) {
            $order_item = TableOrderItem::find($order_item);
        }
        if (!$order_item) {
            return;
        }

        $next = $order_item->qty += $qty;

        if ($next < 0) {
            $order_item->delete();
        } else {
            $order_item->save();
        }

        $this->table_order->refresh();
    }
    function updateSeat($qty = 1)
    {
        $next = $this->table_order->seats += $qty;
        if ($next > 0) {
            $this->table_order->save();
            $this->table_order->refresh();
        }
    }

    public function render()
    {
        return view('livewire.show-order');
    }
}
