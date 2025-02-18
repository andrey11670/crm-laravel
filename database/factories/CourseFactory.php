<?php

namespace Database\Factories;

use App\Http\Controllers\CourseController;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $result = (new CourseController())->__invoke();
        return [
            'course' => $result
        ];
    }
}
