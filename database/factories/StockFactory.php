<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Stock;
use App\Models\warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stock>
 */
class StockFactory extends Factory
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
        if (!session()->has('custom_model_ids')) {
            session(['custom_model_ids' => $modelIds, now()->addMinutes($timeToLive)]);
        }
        $counter = session('counter3', 0);
        //return  session('custom_model_ids' );
        session(['counter3',  $counter, now()->addMinutes($timeToLive)]);
        // return $counter;
        $uniqueIds = session('custom_model_ids');
        //Session::flush();
        //return (session('counter3'));
        $uniqueId = $uniqueIds[$counter]; // Получаем уникальный идентификатор из массива по порядку
        //print_r($counter);
        $counter++; // Увеличиваем счетчик на 1


        session(['counter3' => $counter]); // Обновляем значение счетчика в сессии

        return [
            'product_id' => $uniqueId,
            'warehouse_id' => warehouse::get()->random()->id,
            'stock' => fake()->numberBetween(1  ,100)
        ];
    }
}
