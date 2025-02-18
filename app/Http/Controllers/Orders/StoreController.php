<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Services\Service;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request){
        //проверка на ошибки
        $validatedData = $request->validated();
        $customer = $request['customer'];
        $orderItems = $request['order_items'];
        $quantity = $request['quantity'];

        $result = (new Service())->store($customer, $orderItems, $quantity);
        //если редирект произошел ранише в резулте придет обьект с ошибкой
        if (gettype($result) === "object"){
            return  redirect()->back();
        }
        return redirect()->back()->with('errors', [])->with('success',  'Ваш заказ создан')->withInput();
    }
}
