<?php

namespace Database\Factories;

use App\Enums\PlaceKind;
use App\Models\Place;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Place>
 */
class PlaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->city(),
            'kind' => fake()->randomElement(PlaceKind::cases()),
        ];
    }
}
