<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_item;
use App\Models\Stock;
use App\Services\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CancelController extends Controller
{
    public function __invoke($order){
        //контроллер отменяет активный статус закакза завершенный он не может изменить
            $result = (new Service())->cancel($order);
        //если редирект произошел ранише в резулте придет обьект с ошибкой
        if (gettype($result) === "object"){
            return  redirect()->route('order');
        }

        return redirect()->route('order')->with('message8', 'Заказ отменен')->withInput();
    }
}
