<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Preset>
 */
class PresetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'name' => fake()->words(3, true),
            'pedal_brand' => fake()->randomElement(['Boss', 'Line 6', 'Kemper', 'Fractal Audio', 'Helix', 'TC Electronic']),
            'pedal_model' => fake()->words(2, true),
            'description' => fake()->optional()->paragraph(),
            'settings' => fake()->optional()->text(200),
        ];
    }
}
