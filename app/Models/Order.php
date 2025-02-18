<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer',
        'warehouse_id',
        'status',

    ];
    use SoftDeletes;
    protected $perPage = 10;

    public function warehouse(){
        return $this->belongsTo(Warehouse::class, 'warehouse_id', 'id');
    }
    protected function order_item(){
        return $this->hasMany(Order_item::class, 'order_id');
    }



}
