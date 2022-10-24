<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Models\Order;
use App\Models\TableOrder;
use App\Models\TableOrderItem;
use Livewire\Component;

class SplitOrder extends Component
{

    function mount(Order $order, ?int $table = null)
    {
        $this->table_id = $table;
        $this->order = $order;
        $this->table_orders = $order->table_orders;
        $this->temp_items = [];
        $this->updatedTableId();
    }

    function updatedTableId()
    {
        $this->table_order = $this->table_orders->where('table_id', $this->table_id)->first() ?? $this->table_orders->first();
        $this->table = $this->table_order->table;
    }

    function toRight(TableOrderItem $titem, Item $item)
    {
        $t = &$this->temp_items;
        $t[$titem->id] ??= ['item' => $item, 'qty' => 0, 'table_order_item' => $titem->toArray(), 'table' => $titem->table_order->table->toArray()];
        if ($titem->qty === $t[$titem->id]['qty']) return;
        $t[$titem->id]['qty']++;
    }

    function getTotalProperty()
    {
        $total = 0;
        foreach ($this->temp_items as ['qty' => $qty, 'item' => ['price' => $price]]) {
            $total += $qty * $price;
        }
        return $total;
    }

    function toLeft($index)
    {
        $t = &$this->temp_items;
        if (!isset($t[$index])) return;
        if (!(--$t[$index]['qty'])) {
            unset($t[$index]);
        }
    }
    function confirmSplit()
    {
        $o = Order::create();
        foreach ($this->temp_items as ['qty' => $qty, 'item' => ['id' => $item_id], 'table' => ['id' => $table_id], 'table_order_item' => ['id' => $table_order_item_id]]) {
            $o_toi = TableOrderItem::find($table_order_item_id);
            $o_toi->qty -= $qty;
            $o_toi->save();

            $toparams = ['table_id' => $table_id, 'order_id' => $o->id];
            $to = TableOrder::firstOrCreate($toparams)->firstWhere($toparams);
            $toiprams = ['table_order_id' => $to->id, 'item_id' => $item_id];
            $toi = TableOrderItem::firstOrNew($toiprams, ['qty' => 0]);
            $toi->qty += $qty;
            $toi->save();
        }
        redirect(route('checkout', $o));
    }
    public function render()
    {
        return view('livewire.split-order');
    }
}
