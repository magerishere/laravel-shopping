<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'catNameKey' => $this->faker->word(),
            'catName' => $this->faker->word(),
            'title' => $this->faker->title(),
            'image' => Str::random(),
            'amount' => $this->faker->numberBetween(10000,900000),
            'qty' => $this->faker->numberBetween(10,1000),
            'content' => $this->faker->text(),
        ];
    }
}
