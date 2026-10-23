<?php

namespace Database\Factories;

use App\Enums\Color;
use App\Models\Item;
use App\Models\Place;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'place_id' => Place::factory(),
            'name' => fake()->words(3, true),
            'description' => fake()->sentence(),
            'color' => fake()->randomElement(Color::cases()),
            'found_on' => fake()->dateTimeBetween('-30 days', 'now'),
            'returned_at' => null,

        ];
    }
}
