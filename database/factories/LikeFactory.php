<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'user_id',
            // 'likeable_type',
            // 'likeable_id',
            'type' => rand(0,1),
        ];
    }
}
