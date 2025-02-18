<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function __invoke(){
        $product = Product::with('stock')->get();
        return  View('product')->with( 'product', $product);
    }
}
