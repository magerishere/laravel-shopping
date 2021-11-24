<?php

namespace Database\Factories;

use App\Models\CommentReply;
use App\Models\Like;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentReplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // user_id,
            // comment_id,
            'body' => $this->faker->text(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function(CommentReply $commentReply) {
            Like::factory()->count(rand(1,50))->create([
                'user_id' => $commentReply->user_id,
                'likeable_type' => 'CommentReply',
                'likeable_id' => $commentReply->id,
            ]);
        });
    }
}
