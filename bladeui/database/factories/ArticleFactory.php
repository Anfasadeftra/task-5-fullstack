<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'title' => $this->faker->word(),
            'content' => $this->faker->sentence(),
            'image' => $this->faker->image(
                dir: storage_path('app'),
                width: 250,
                height: 250,
                fullPath: false),
            'user_id' => User::factory()->create()->id, 
            'category_id' => Category::factory()->create()->user_id,
        ];
    }
}
