<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Services\Service;

class ShowController extends Controller
{
    public function __invoke($order)
    {
        //страница изменения заказа
        $result = (new Service())->show($order);

        return View('show')->with('order', $result['order'])->with('orderItems', $result['orderItems'])->with('products', $result['products']);
    }
}
