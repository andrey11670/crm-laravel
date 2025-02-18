<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class CompleteController extends Controller
{
    public function __invoke($order){
        //кнопка завершения заказа при завершении заказа товар не возвращается на склад

        $order_status = Order::find($order);
        $order_status->status = 'completed';
        $order_status->save();

        return redirect()->route('order')->with('message10', 'Заказ завершен')->withInput();
    }
}
