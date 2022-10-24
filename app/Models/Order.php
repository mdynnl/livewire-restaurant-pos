<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;
    protected $casts = [
        'status' => OrderStatus::class,
    ];

    function table_orders()
    {
        return $this->hasMany(TableOrder::class, 'order_id');
    }

    function get_table_seats()
    {
        return $this->table_orders->sum('seats');
    }
    function tables()
    {
        return $this->belongsToMany(Table::class, TableOrder::class);
    }

    function total()
    {
        return DB::table('orders')
            ->leftJoin('table_order', 'table_order.order_id', '=', 'orders.id')
            ->leftJoin('table_order_item', 'table_order_item.table_order_id', '=', 'table_order.id')
            ->leftJoin('items', 'items.id', '=', 'table_order_item.item_id')
            ->where('orders.id', $this->id)
            ->sum(DB::raw('items.price * table_order_item.qty'));
    }
}
