<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Services\Service;


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
