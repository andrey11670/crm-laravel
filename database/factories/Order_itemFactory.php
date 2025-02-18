<?php

namespace Database\Factories;


use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class Order_itemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $modelIds = Product::inRandomOrder()->pluck('id')->toArray(); // получаем все существующие id из модели
        $timeToLive = 0.1;
        if (!session()->has('custom_model')) {
            session(['custom_model' => $modelIds, now()->addMinutes($timeToLive)]);
        }
        $counter = session('counter4', 0);
        //print_r(session('custom_model' ));
        session(['counter4',  $counter, now()->addMinutes($timeToLive)]);
        // return $counter;

        $uniqueIds = session('custom_model');
        //Session::flush();
        //return (session('counter3'));
        if ($counter > 9){
            $counter = 0;
        }
        $uniqueId = $uniqueIds[$counter]; // Получаем уникальный идентификатор из массива по порядку
        //print_r($counter);
        $counter++; // Увеличиваем счетчик на 1
        session(['counter4' => $counter]); // Обновляем значение счетчика в сессии

/*---------------------------------------------------------------------------------------*/
        $order = Order::inRandomOrder()->pluck('id')->toArray();

        if (!session()->has('order')) {
            session(['order' => $order, now()->addMinutes($timeToLive)]);
        }
        $sessionOrder = session('order');
        $counterV = session('counterV', 0);
        session(['counterV',  $counterV, now()->addMinutes($timeToLive)]);

        $orderId = $sessionOrder[$counterV]; // Получаем уникальный идентификатор из массива по порядку

        //print_r($sessionOrder);

        $counterX = session('counterX', 1);
        session(['counterX',  $counterX, now()->addMinutes($timeToLive)]);

        if ($counterX % 5 == 0) {
            $counterV++; // Увеличиваем счетчик на 1
            session(['counterV' => $counterV]); // Обновляем значение счетчика в сессии
        }

        $counterX++; // Увеличиваем счетчик на 1
        session(['counterX' => $counterX]); // Обновляем значение счетчика в сессии
        //print_r($counterX);

        return [
            'order_id' => $orderId,
            'product_id' => $uniqueId,
            'count' =>  fake()->numberBetween(1  , 20)
        ];
    }
}
