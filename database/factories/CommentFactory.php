<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "body" => $this->faker->paragraph(),
            // randomly select a post among the existing ones
            "post_id" => \App\Models\Post::all()->random()->id,
            "user_id" => 1
        ];
    }
}
