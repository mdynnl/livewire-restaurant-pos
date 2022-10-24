<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    function table_orders()
    {
        return $this->hasMany(TableOrder::class);
    }

    function active_table_orders()
    {
        return $this->table_orders()->whereHas('order', fn ($o) => $o->whereNot('status', OrderStatus::Paid));
    }

    function all_orders()
    {
        return $this->belongsToMany(Order::class, TableOrder::class)->distinct();
    }

    function active_orders()
    {
        return $this->all_orders()->whereNot('status', OrderStatus::Paid);
    }

    function get_occupied_percent()
    {
        return $this->get_occupied_seats() / $this->seats;
    }

    function get_occupied_seats()
    {
        return $this->active_table_orders()->sum('seats');
    }
}
