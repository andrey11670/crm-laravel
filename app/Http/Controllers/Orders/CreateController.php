<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    public function __invoke(Request $request){
        //создание заказа
        $product = Product::with('stock')->get();

        return View('create')->with('product', $product);
    }
}



