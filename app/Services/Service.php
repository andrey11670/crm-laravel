<?php


namespace App\Services;


use App\Models\Movement_history;
use App\Models\Order;
use App\Models\Order_item;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Warehouse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class Service
{
    public function cancel($order){
        try {
            DB::beginTransaction();
            //устонавливаем статус отмены заказу
            $order_status = Order::find($order);
            if ($order_status->status === 'active') {
                //находим все составляющие заказа
                $order_items = Order_item::where('order_id', $order)->get();
                //dd($order_items);
                foreach ($order_items as $key => $item) {
                    //возвращаем товар на склад
                    $stock = Stock::where('product_id', $item['product_id'])->first();
                    $stock->stock = $stock->stock + $item->count;
                    $stock->save();
                }
                //устонавливаем статус отмены
                $order_status->status = 'canceled';
                $order_status->save();
            }elseif ($order_status->status === 'completed'){
                return redirect()->route('order')->with('message5', 'Нельзя отменить заказ он завершен')->withInput();
            }
            DB::commit();
        } catch (\Exception $exception ){

            DB::rollBack();
            return $exception->getMessage();
        }
        return 1;
    }

    public function movement($warehouse, $product, $startDate, $endDate, $limit){
        $query = Movement_history::query();

        if ($warehouse) {
            // Фильтр по складу
            $query->where('warehouse_id',  $warehouse);
            //dd($query);
        }

        if ($product) {
            // Фильтр по товару
            $query->where('product_id', $product);
            //dd($query);
        }

        if ($startDate && $endDate) {
            // Фильтр по датам
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        // Настраиваемая сортировка
        $query->orderBy('created_at', 'desc');

        // Получение данных с пагинацией
        $perPage = $limit ?? 20;
        $movement = $query->paginate($limit);

        $warehouse = warehouse::with('movement')->get();
        $product = Product::with('movement')->get();
        //создаем массив для фильтра тваров
        $warehouse_name = [];
        foreach ($movement as $key => $value){
            $stock = Stock::where('product_id', $value['product_id'])->first();
            //находим остаток товара для вывода
            $value['stock'] = $stock['stock'];
            $warehouse_name[] = $value->warehouse['warehouses'];
        }
        return ['movement' =>$movement, 'warehouse_name' => $warehouse_name, 'warehouse' => $warehouse, 'product' => $product];
    }
    public function order($request){
        $warehouse = Warehouse::all();
        // отдельно получаем имя заказчика с полем кастомер для View фильтра по имени
        $customer = Order::with('warehouse')->select('orders.id', 'orders.customer')->get();
        $query = Order::query();

        $limit = $request ->input('limit');
        $customer_request = $request ->input('customer');
        $warehouse_request = $request ->input('warehouse');
        //Фильтры
        if ($customer_request){
            $query ->where('customer', $customer_request);
        }

        if ($warehouse_request){
            $query ->where('warehouse_id', $warehouse_request);
        }
        //проверяем на пустоту пагинацию по умолчанию ставим 20
        $perPage = $limit ?? 20;
        $order = $query->paginate($perPage);
        // кладем имя склада в табл заказа
        foreach ($order as $key => $value){
            $value['warehouse_id'] = $value->warehouse['warehouses'];
        }
        return ['order' => $order, 'warehouse' => $warehouse, 'customer' => $customer];
    }
    public function resume($order){
        try {
            DB::beginTransaction();
            //возобновление заказа
            $order_status = Order::find($order);
            //проверка на статус заказа
            if ( $order_status->status === 'canceled') {
                //все товары в заказе будут возвращены со склада
                $order_items = Order_item::where('order_id', $order)->get();
                foreach ($order_items as $key => $item) {
                    $stock = Stock::where('product_id', $item['product_id'])->first();
                    //отнимем от остатков на складе
                    if ($stock->stock <  $item->count) {
                        //если недостаточно товаров на складе выходит ошибка
                        return redirect()->route('order')->with('message7', 'Ошибка на складе: не хватает товара')->withInput();
                    }
                    $stock->stock = $stock->stock - $item->count;
                    $stock->save();
                    //сохраняем остаток
                }
                //меняем статус заказа
                $order_status->status = 'active';
                $order_status->save();

            }elseif ($order_status->status === 'completed'){
                return redirect()->route('order')->with('message6', 'Нельзя возобновить заказ он завершен')->withInput();
            }
            DB::commit();
        } catch (\Exception $exception ){
            DB::rollBack();
            return $exception->getMessage();
        }
        return 1;
    }
    public function show($order){
        $order = Order::find($order);
        $orderItems = $order->order_item;
        //проверка на отсутствие товаров в заказе
        if(!count($orderItems)){
            return redirect()->route('order');
        }
        //находим каждый продукт заказа с его данными
        foreach ($orderItems as $key => $value){
            $product = Product::find( $value['product_id'] );
            $products[] = $product;
        }
        return ['order' => $order, 'orderItems' => $orderItems, 'products' => $products];
    }
    public function store($customer, $orderItems, $quantity){
        try {
            DB::beginTransaction();
            // Создай новый заказ
            $order = Order::create([
                'customer' => $customer,
                'warehouse_id' => warehouse::pluck('id')->random(),//случайный склад
                'status' => 'active' // Установи статус заказа на "active"
            ]);
            // Создай позиции заказа
            foreach ($orderItems as $key => $item) {
                // Проверь наличие товара
                $product = Product::findOrFail($item);
                $stock = Stock::where( 'product_id', $item)->first();
                //Проверим остаток груза на складе осталось ли товар
                if ($stock->stock - $quantity[$item] < 0){
                    return redirect()->back()->withErrors(['message' => 'Вы слишком много заказали']);
                }
                $stock->stock = $stock->stock - $quantity[$item];
                $stock->save();
                // Создай позиции заказа и свяжи ее с заказом и товаром
                $order_item = Order_item::create([
                    'order_id' => $order->id,
                    'product_id' => $item,
                    'count' => $quantity[$item]
                ]);
            }
            DB::commit();
        } catch (\Exception $exception ){
            DB::rollBack();
            return $exception->getMessage();
        }
    }
    public function update($order, $validated, $count){
        //dd($order, $validated, $count);
        try {
            DB::beginTransaction();
            //dd($count, $validated['order_items']);
            $order_status =  Order::find($order);
            // проверяем статус заказа не все заказы можно редактировать
            if ($order_status->status === 'canceled')
                return redirect()->back()->with('message8', 'Нельзя редактировать заказ отменен')->withInput();
            if ($order_status->status === 'completed')
                return redirect()->back()->with('message9', 'Нельзя редактировать заказ завершен')->withInput();
            //массив с измененным числом товаров
            foreach ($count as $key => $value) {

                //залазим в талицу товара заказа находим нужный нам товар
                $order_item = Order_item::where('product_id', $key)->where('order_id', $order)->first();
                //находим остаток этого товара
                $stock = Stock::where('product_id', $key)->first();
                //находим разницу товара было и стало
                $x = $value - $order_item->count;
                //вкладываем таблицу товара заказа новое число товара
                $order_item->count = $value;
                //проверяем на ошибку остатка на складе
                //dd($stock->stock , $x );
                if ($stock->stock - $x < 0){
                    //dd($stock->stock, $x);
                    return redirect()->back()->with(['message' => ' На складе нехватает товара'])->withInput();
                }


                //в таблицу остатка товара вкладываем новые данные
                $stock->stock = $stock->stock - $x;
                $order_item->save();
                $stock->save();
                //dd($stock);
            }
            //проверяем есть ли товар на удаление
            if (isset($validated['order_items'])){
                $order_items = $validated['order_items'];
                //dd($order_items);
                foreach ($order_items as $key => $value){                   //удаляем товары
                    //при удалении товара из заказа он возвращается на склад
                    $item = Order_item::find($value);
                    $stock = Stock::where('product_id', $item->product_id)->first();
                    //остатки на складе складываются с текщим чилом в заказе
                    $stock->stock = $stock->stock +  $count[$item->product_id];
                    $stock->save();
                    $item->delete();
                }
            }

            unset($validated['order_items'], $validated['quantity']);
            //редактируем имя заказчика
            $customer = Order::find($order);
            $customer -> customer = $validated['customer'];
            $customer -> save();
            ;
            DB::commit();
        }catch (\Exception $exception ){
            DB::rollBack();
            return $exception->getMessage();
        }
        //проверяем остались ли товары в заказе  если нет удаляем заказ
        $orderItems = Order_item::where('order_id', $order)->get();
        if ($orderItems->isEmpty()){
            $item = Order::find($order);
            $item->delete();
            return Redirect::to("/orders")->with('message4', 'Вы удалили все товары из заказа ваш заказ удален')->withInput();
        }
        return 1;
    }




}
