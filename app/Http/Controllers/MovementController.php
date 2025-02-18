<?php

namespace App\Http\Controllers;


use App\Models\Movement_history;
use App\Models\Product;
use App\Models\Stock;
use App\Models\warehouse;
use App\Services\Service;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MovementController extends Controller
{
        public function __invoke(Request $request)
        {
            $warehouse = $request->input('warehouse');
            $product = $request->input('product');
            $startDate = $request->input('startDate');
            $endDate = $request->input('endDate');
            $limit = $request->input('limit', 10);

           $result = (new Service())->movement($warehouse, $product, $startDate, $endDate, $limit);
            //dd($result);
            return View('movement')->with('movement', $result['movement'])->with('warehouse_name', $result['warehouse_name'])->with('warehouse', $result['warehouse'])->with('product', $result['product']);
        }
}
