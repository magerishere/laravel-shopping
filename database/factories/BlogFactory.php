<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // user_id
            'views' => rand(10,1000),
            'catNameKey' => $this->faker->word(),
            'catName' => $this->faker->word(),
            'title' => $this->faker->title(),
            'image' => Str::random(),
            'content' => $this->faker->text(),
        ];
    }
}
