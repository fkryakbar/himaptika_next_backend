<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AnnouncementModel>
 */
class AnnouncementModelFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->realText(100),
            'link' => fake('id_ID')->domainName()
        ];
    }
}
