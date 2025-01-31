<?php

namespace App\Providers;

use App\Repositories\Contracts\BillRepositoryInterface;
use App\Repositories\Contracts\ExpenseRepositoryInterface;
use App\Repositories\Contracts\IncomeRepositoryInterface;
use App\Repositories\Contracts\SavingRepositoryInterface;
use App\Repositories\Eloquent\BillRepository;
use App\Repositories\Eloquent\ExpenseRepository;
use App\Repositories\Eloquent\IncomeRepository;
use App\Repositories\Eloquent\SavingRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->bindRepositories();
    }

    private function bindRepositories()
    {
        $this->app->bind(
            IncomeRepositoryInterface::class,
            IncomeRepository::class,
        );

        $this->app->bind(
            BillRepositoryInterface::class,
            BillRepository::class,
        );

        $this->app->bind(
            ExpenseRepositoryInterface::class,
            ExpenseRepository::class,
        );

        $this->app->bind(
            SavingRepositoryInterface::class,
            SavingRepository::class,
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
