<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\Like;
use App\Models\User;
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
            // 'user_id',
            'views' => rand(10,1000),
            'catNameKey' => $this->faker->word(),
            'catName' => $this->faker->word(),
            'title' => $this->faker->title(),
            'image' => Str::random(),
            'content' => $this->faker->text(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function(Blog $blog) {
            Comment::factory()->count(rand(1,5))->create([
                'user_id' => $blog->user_id,
                'commentable_type' => 'Blog',
                'commentable_id' => $blog->id
            ]);
            Like::factory()->count(rand(1,50))->create([
                'user_id' => $blog->user_id,
                'likeable_type' => 'Blog',
                'likeable_id' => $blog->id,
            ]);
        });
    }
}
