<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\DB;

class TableOrder extends Pivot
{
    function table()
    {
        return $this->belongsTo(Table::class);
    }
    function order()
    {
        return $this->belongsTo(Order::class);
    }
    function order_items()
    {
        return $this->hasMany(TableOrderItem::class, 'table_order_id');
    }
    function items()
    {
        return $this->belongsToMany(Item::class, TableOrderItem::class, 'table_order_id', 'item_id');
    }
    function total()
    {
        return DB::table('table_order')
            ->leftJoin('table_order_item', 'table_order_item.table_order_id', '=', 'table_order.id')
            ->leftJoin('items', 'items.id', '=', 'table_order_item.item_id')
            ->where('table_order.id', $this->id)
            ->sum(DB::raw('items.price * table_order_item.qty'));
    }
}
