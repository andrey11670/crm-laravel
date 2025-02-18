<?php

namespace App\Http\Controllers\Warehouses;

use App\Http\Controllers\Controller;
use App\Models\Warehouse;

class WarehouseController extends Controller
{
    public function __invoke(){
        $warehouse = Warehouse::all();
        return View('warehouse')->with('warehouse', $warehouse);
    }
}
