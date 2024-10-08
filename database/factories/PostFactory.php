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
            'title' => $this->faker->sentence,
            'slug' => $this->faker->slug(),
            'description' => $this->faker->paragraph,
            'category_post_id' => 1,
            'content' => $this->faker->paragraph,
            'image' => $this->faker->imageUrl(),
            'status' => 1,
        ];
    }
}
