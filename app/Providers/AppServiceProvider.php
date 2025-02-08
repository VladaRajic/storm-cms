<?php

namespace App\Providers;

use App\Http\Requests\UserRequest;
use App\Services\CommentService;
use App\Services\ICommentService;
use App\Services\IProductService;
use App\Services\IUserService;
use App\Services\ProductService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IProductService::class, ProductService::class);
        $this->app->bind(IUserService::class, UserService::class);
        $this->app->bind(ICommentService::class, CommentService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
