<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Model::preventLazyLoading();

        Relation::enforceMorphMap([
            'Blog' => 'App\Models\Blog',
            'Product' => 'App\Models\Product',
            'Comment' => 'App\Models\Comment',
            'CommentReply' => 'App\Models\CommentReply'
        ]);
    }
}
