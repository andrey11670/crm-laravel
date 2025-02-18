<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Controller;
use App\Services\Service;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __invoke(Request $request){

        $result = (new Service())->order($request);
        $course = (new CourseController())->__invoke();

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










