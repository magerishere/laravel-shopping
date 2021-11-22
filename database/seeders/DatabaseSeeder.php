<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
        ->count(10)
        ->hasAttached(
            Blog::factory()
            ->count(30)
            ->state(function(array $attributes,User $user) {
                Log::alert($attributes);
                return ['user_id' => $user->id];
            }),
            ['type' => rand(0,1)]) // like or dislike
            ->create();
        
        Product::factory()->count(50)->create();
        
        // \App\Models\User::factory(10)->create();
    }
}
