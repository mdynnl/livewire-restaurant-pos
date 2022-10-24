<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class TableOrderItem extends Pivot
{
    function item()
    {
        return $this->belongsTo(Item::class);
    }

    function table_order()
    {
        return $this->belongsTo(TableOrder::class, 'table_order_id');
    }
}
