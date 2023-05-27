<?php

namespace App\Providers;

use App\Services\Hr\HrService;
use App\Services\Hr\Interfaces\HrServiceInterface;
use App\Services\Auth\AuthService;
use App\Services\Auth\Interfaces\AuthServiceInterface;
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
        $this->app->bind(HrServiceInterface::class, HrService::class);
        $this->app->bind(AuthServiceInterface::class,AuthService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
