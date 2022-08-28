<?php

namespace Database\Factories;

use App\Models\User;
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
    public function definition()
    {
        return [
            'title' => $this->faker->word(),
            'content' => $this->faker->sentence(),
            'image' => $this->faker->imageUrl(),
            'user_id' => $this->faker->unique()->numberBetween(1, User::count())
            //'user_id' => User::factory()->create()->id
        ];
    }
}
