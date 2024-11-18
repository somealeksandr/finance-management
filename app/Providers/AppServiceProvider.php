<?php

namespace App\Providers;

use App\Repositories\Interfaces\TransactionRepositoryInterface;
use App\Repositories\TransactionRepository;
use App\Services\Interfaces\TransactionServiceInterface;
use App\Services\TransactionService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(TransactionServiceInterface::class, TransactionService::class);
        $this->app->singleton(TransactionRepositoryInterface::class, TransactionRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
