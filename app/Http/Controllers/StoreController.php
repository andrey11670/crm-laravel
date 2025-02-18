<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Models\Order;
use App\Models\Order_item;
use App\Models\Product;
use App\Models\Stock;
use App\Models\warehouse;
use App\Services\Service;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

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
