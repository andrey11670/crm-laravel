<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;
    protected $fillable = [
        'warehouses'
    ];


    protected function order(){
        return $this->hasMany(Order::class, 'warehouse_id', 'id');
    }
    protected function stock(){
        return $this->hasMany(Stock::class, 'warehouse_id', 'id');
    }
    public function movement()
    {
        return $this->hasMany(Movement_history::class, 'warehouse_id', 'id');
    }
}
