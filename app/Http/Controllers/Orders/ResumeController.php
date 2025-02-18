<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Services\Service;

class ResumeController extends Controller
{
    public function __invoke($order){

        $result = (new Service())->resume($order);
        //если редирект произошел ранише в резулте придет обьект с ошибкой
        if (gettype($result) === "object"){
            return  redirect()->route('order');
        }
        return redirect()->route('order')->with('message9', 'Заказ восстановлен')->withInput();
    }
}

