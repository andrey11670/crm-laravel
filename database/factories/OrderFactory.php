<?php

namespace Database\Factories;

use App\Models\warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer' => fake()->firstName(),
            'warehouse_id' => warehouse::get()->random()->id,
            'status' => fake()->randomElement(['completed', 'canceled', 'active']),

        ];
    }
}
