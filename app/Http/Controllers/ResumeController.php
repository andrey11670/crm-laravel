<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_item;
use App\Models\Stock;
use App\Services\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

