<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\UseCase\Product\ProductUseCase;
use App\UseCase\Product\ProductService;
use App\Infrastructure\Repositories\Product\IProductRepository;
use App\Infrastructure\Repositories\Product\ProductRepository;
use App\Infrastructure\Repositories\User\IUserRepository;
use App\Infrastructure\Repositories\User\UserRepository;
use App\UseCase\User\UserService;
use App\UseCase\User\UserUseCase;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IProductRepository::class, ProductRepository::class);
        $this->app->bind(ProductUseCase::class, ProductService::class);

        //User
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(UserUseCase::class, UserService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
