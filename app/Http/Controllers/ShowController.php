<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Services\Service;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShowController extends Controller
{
    public function __invoke($order)
    {
        //страница изменения заказа
        $result = (new Service())->show($order);

        return View('show')->with('order', $result['order'])->with('orderItems', $result['orderItems'])->with('products', $result['products']);
    }
}
