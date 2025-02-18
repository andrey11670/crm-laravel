<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price'
    ];

    protected function order_item(){
        return $this->hasMany(Order_item::class, 'product_id');
    }
    public function stock()
    {
        return $this->hasOne(Stock::class, 'product_id', 'id');
    }
    public function movement()
    {
        return $this->hasMany(Stock::class, 'product_id', 'id');
    }


}
