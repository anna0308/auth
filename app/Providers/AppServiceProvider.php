<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\User;
use App\Post;
use App\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        view()->composer('layouts.app', function($view) {
            $count_user = User::count();
            $count_post = Post::count();
            $count_category = Category::count();
            $view->with(['count_user' => $count_user, 'count_post' => $count_post, 
            'count_category' => $count_category]);
        });
    }
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
