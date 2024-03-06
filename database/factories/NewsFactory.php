<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => fake()->title(),
            'description'=>fake()->text(),
            'published'=>fake()->boolean(100),
            'published_at'=>fake()->dateTime(),
            'img_path'=>fake()->filePath()
        ];
    }
}
