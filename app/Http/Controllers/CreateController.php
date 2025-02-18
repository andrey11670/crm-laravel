<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class CreateController extends Controller
{
    public function __invoke(Request $request){
        //создание заказа
        $product = Product::with('stock')->get();

        return View('create')->with('product', $product);
    }
}



