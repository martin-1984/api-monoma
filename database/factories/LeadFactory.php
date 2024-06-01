<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class LeadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'source' => $this->faker->randomElement(['Website', 'Phone', 'Email']),
            'owner' => User::pluck('id')->random(),
            'created_by' => User::pluck('id')->random(),
        ];
    }
}
