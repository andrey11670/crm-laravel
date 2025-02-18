<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WarehouseController extends Controller
{
    public function __invoke(){
        $warehouse = Warehouse::all();
        return View('warehouse')->with('warehouse', $warehouse);
    }
}
