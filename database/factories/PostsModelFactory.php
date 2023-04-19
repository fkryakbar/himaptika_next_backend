<?php

namespace Database\Factories;

use App\Models\PostsModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PostsModelFactory extends Factory
{
    protected $model = PostsModel::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->realText(100),
            'slug' => fake()->slug(),
            'author' => 'Administrator',
            'description' => fake()->realText(10),
            'image_path' => 'storage/kIgeB8BYXy9ALF4ixJb0z3hj3BtYvAdk7LetvPtZ.jpg',
            'content' => fake()->realText(500),
            'views' => fake()->randomDigit()
        ];
    }
}
