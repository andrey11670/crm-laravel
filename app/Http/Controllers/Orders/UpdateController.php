<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateRequest;
use App\Services\Service;
use Illuminate\Support\Facades\Redirect;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, $order){
        $validated = $request->validated();
        $count = $validated['count'];
        $result = (new Service())->update($order, $validated, $count);
        //если редирект произошел ранише в резулте придет обьект с ошибкой
        if (gettype($result) === "object")
            return  Redirect::to("/orders/{$order}");

        return  Redirect::to("/orders/{$order}")->with('errors', [])->with('success', 'Заказ изменен');
    }
}
