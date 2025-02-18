<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movement_history extends Model
{
    use HasFactory;
    protected $fillable =[
        'product_id',
        'action',
        'order_items_id',
        'stock',
        ''

    ];
    protected function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }protected function order_items(){
        return $this->belongsTo(Order_item::class, 'order_items_id', 'id');
    }
    protected function warehouse(){
        return $this->belongsTo(Warehouse::class, 'warehouse_id', 'id');
    }
}
