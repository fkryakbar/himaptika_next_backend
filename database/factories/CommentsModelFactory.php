<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CommentsModel>
 */
class CommentsModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'post_slug' => 'eum-reiciendis-commodi-debitis-ea-quibusdam-illo-animi-quidem',
            'email' => fake('id_ID')->email(),
            'name' => fake('id_ID')->name(),
            'comment' => fake('id_ID')->text(),
        ];
    }
}
