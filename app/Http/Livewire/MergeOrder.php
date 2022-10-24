<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\TableOrder;
use Livewire\Component;

class MergeOrder extends Component
{
    public $selected = [];
    public $tables_selected = [];
    function mount(Order $order)
    {
        $this->order = $order;
        $this->all_orders = Order::whereNot('status', OrderStatus::Paid)->whereNot('id', $order->id)->get();
    }

    public function merge()
    {
        foreach ($this->selected as $key => $value) {
            if (!$value) continue;
            $order = Order::find($key);
            foreach ($order->table_orders as $table_order) {
                $old_table_order = $this->order->table_orders()->where('table_id', $table_order->table_id)->first();
                if ($old_table_order) {
                    foreach ($table_order->order_items as $order_item) {
                        $old_order_item = $old_table_order->order_items()->where('item_id', $order_item->item_id)->first();
                        if ($old_order_item) {
                            $old_order_item->qty += $order_item->qty;
                            $old_order_item->save();
                            $order_item->delete();
                        } else {
                            $order_item->table_order()->associate($old_table_order)->save();
                        }
                    }
                    $table_order->delete();
                } else {
                    $table_order->order()->associate($this->order)->save();
                }
            }
            $order->delete();
            $this->reset('selected', 'tables_selected');
            $this->mount($this->order);
            $this->order->refresh();
            // redirect(route('order', $this->order));
        }
    }
    public function unmerge()
    {
        foreach ($this->tables_selected as $id => $selected) {
            if (!$selected) continue;
            TableOrder::find($id)->order()->associate(Order::create())->save();
        }
        $this->reset('selected', 'tables_selected');
        $this->mount($this->order);
        $this->order->refresh();
    }

    public function render()
    {
        return view('livewire.merge-order');
    }
}
