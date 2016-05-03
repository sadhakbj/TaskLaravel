<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\Article\ArticleRepositoryInterface',
            'App\Repositories\Article\ArticleRepository'
        );

        $this->app->bind(
            'App\Repositories\Comment\CommentRepositoryInterface',
            'App\Repositories\Comment\CommentRepository'
        );
    }
}
