<?php

namespace Database\Factories;

use App\Models\Sale;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Sale::class;

    public function definition()
    {
        return [
            'type' => $this->faker->randomElement(['BOGO', 'Flash', 'Season']),
            'name' => $this->faker->sentence,
            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date,
            'banner' => $this->faker->imageUrl,
            'position' => $this->faker->randomDigit,
        ];
    }
}
