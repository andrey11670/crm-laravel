<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\warehouse;
use App\Services\Service;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Pagination\Concerns\Order\Paginatable;
use PhpParser\Node\Stmt\Else_;

class OrderController extends Controller
{
    public function __invoke(Request $request){

        $result = (new Service())->order($request);
        $course = (new CourseController())->__invoke();
        //dd($course);

        return View('order')->with('order', $result['order'])->with('warehouse', $result['warehouse'])->with('customer', $result['customer'])->with('course', $course);
    }
}




























/*if($request->has('limit') or $request->has('warehouses')) {
    if ($request->has('limit') && $request->has('warehouses')) {
        $order = Order::query()->where('warehouse_id', $request['warehouses'])->paginate($request->input('limit'));
        //
    }
    elseif ($request->has('warehouses')){
        $order = Order::query()->where('warehouse_id', $request['warehouses'])->get();
    }
    else {
        $order = Order::query()->paginate($request->input('limit'));
        // dd($order);
    }
}else{
    $order = Order::query()->get();

}*/










