<?php

namespace App\Providers;

use App\Services\Admin\AdminService;
use App\Services\Admin\Interfaces\AdminServiceInterface;
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
        $this->app->bind(AdminServiceInterface::class, AdminService::class);
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
