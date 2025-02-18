<?php

namespace App\Http\Controllers\Movement;


use App\Http\Controllers\Controller;
use App\Services\Service;
use Illuminate\Http\Request;


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

            return View('movement')->with('movement', $result['movement'])->with('warehouse_name', $result['warehouse_name'])->with('warehouse', $result['warehouse'])->with('product', $result['product']);
        }
}
