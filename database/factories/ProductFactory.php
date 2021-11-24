<?php

namespace Database\Factories;

use App\Models\CommentReply;
use App\Models\Like;
use App\Models\Product;
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
            // 'user_id'
            'views' => rand(10,1000),
            'catNameKey' => $this->faker->word(),
            'catName' => $this->faker->word(),
            'title' => $this->faker->title(),
            'image' => Str::random(),
            'amount' => $this->faker->numberBetween(10000,900000),
            'qty' => $this->faker->numberBetween(10,1000),
            'content' => $this->faker->text(),

        ];
    }

    public function configure()
    {
        return $this->afterCreating(function(Product $product) {
            CommentReply::factory()->count(rand(1,4))->create([
                'user_id' => $product->user_id,
                'comment_id' => $product->id,
            ]);
            Like::factory()->count(rand(1,50))->create([
                'user_id' => $product->user_id,
                'likeable_type' => 'Product',
                'likeable_id' => $product->id,
            ]);
        });
    }
}
