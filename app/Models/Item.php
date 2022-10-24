<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = ['item_id'];
    function category()
    {
        return $this->belongsTo(Category::class);
    }

    function table_orders()
    {
        return $this->belongsToMany(TableOrder::class, TableOrderItem::class,  'item_id', 'table_order_id');
    }

    function table_order_items()
    {
        return $this->hasMany(TableOrderItem::class,  'item_id');
    }
}
