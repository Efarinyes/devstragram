<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titol'=> $this->faker->sentence(5),
            'descripcio'=> $this->faker->sentence(20),
            'imatge'=> $this->faker->uuid().'.jpg',
            'user_id'=> $this->faker->randomElement([16, 17])
        ];
    }
}
