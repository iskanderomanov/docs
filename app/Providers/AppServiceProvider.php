<?php

namespace App\Providers;

use App\Services\ReportCard\Interfaces\ReportCardServiceInterface;
use App\Services\ReportCard\ReportCardService;
use App\Services\User\UserService;
use App\Services\User\Interfaces\UserServiceInterface;
use App\Services\Auth\AuthService;
use App\Services\Auth\Interfaces\AuthServiceInterface;
use App\Services\Position\Interfaces\PositionServiceInterface;
use App\Services\Position\PositionService;
use App\View\Composers\NavbarComposer;
use App\View\NavbarView;
use Illuminate\Support\Facades\View;
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
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(AuthServiceInterface::class,AuthService::class);
        $this->app->bind(PositionServiceInterface::class, PositionService::class);
        $this->app->bind(ReportCardServiceInterface::class, ReportCardService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.master', NavbarView::class);
    }
}
