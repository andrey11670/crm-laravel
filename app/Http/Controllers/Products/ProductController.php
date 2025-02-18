<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function __invoke(){
        $product = Product::with('stock')->get();
        return  View('product')->with( 'product', $product);
    }
}
