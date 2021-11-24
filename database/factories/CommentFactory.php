<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\CommentReply;
use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
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
            // 'commentable_type',
            // 'commentable_id',
            'body' => $this->faker->text(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function(Comment $comment) {
            CommentReply::factory()->count(rand(1,3))->create([
                'user_id' => $comment->user_id,
                'comment_id' => $comment->id,
            ]);
            Like::factory()->count(rand(1,50))->create([
                'user_id' => $comment->user_id,
                'likeable_type' => 'Comment',
                'likeable_id' => $comment->id,
            ]);
        });
    }
}
