<?php

use App\Http\Controllers\Web\Accounting\AccountingController;
use App\Http\Controllers\Web\Auth\AuthController;
use App\Http\Controllers\Web\Hr\HrController;
use App\Http\Controllers\Web\Hr\PositionController;
use App\Http\Controllers\Web\Hr\UserController;
use App\Http\Controllers\Web\TimeKeeper\TimeKeeperController;
use App\Utils\MiddlewareNames;
use App\Utils\RouteConstants;
use App\Utils\RouteNames;
use Illuminate\Support\Facades\Route;


/**
 * Маршрутизатор для аутентификации
 */
Route::group([
    RouteConstants::ROUTE_PREFIX => RouteConstants::ROUTE_PREFIX_AUTH
], function () {
    Route::get('/login', [AuthController::class, 'getLoginPage'])->name(RouteNames::GET_LOGIN);
    Route::post('/post', [AuthController::class, 'postLogin'])->name(RouteNames::POST_LOGIN);
});

/**
 * Маршрутизатор для отдел кадров
 */
Route::middleware([MiddlewareNames::AUTH_MIDDLEWARE, MiddlewareNames::HR_MIDDLEWARE])->group(function () {
    Route::get('/', [HrController::class, 'dashboard'])->name(RouteNames::HR_DASHBOARD);
    Route::resource('/positions', PositionController::class)->names([
        RouteConstants::RESOURCE_INDEX => RouteNames::POSITION_INDEX,
        RouteConstants::RESOURCE_CREATE => RouteNames::POSITION_CREATE,
        RouteConstants::RESOURCE_STORE => RouteNames::POSITION_STORE,
        RouteConstants::RESOURCE_SHOW => RouteNames::POSITION_SHOW,
        RouteConstants::RESOURCE_EDIT => RouteNames::POSITION_EDIT,
    ])->except(RouteConstants::RESOURCE_UPDATE);
    Route::post('/positions/{position}', [PositionController::class, 'update'])->name(RouteNames::POSITION_UPDATE);

    Route::resource('/users', UserController::class)->names([
        RouteConstants::RESOURCE_INDEX => RouteNames::USER_INDEX,
        RouteConstants::RESOURCE_CREATE => RouteNames::USER_CREATE,
        RouteConstants::RESOURCE_STORE => RouteNames::USER_STORE,
        RouteConstants::RESOURCE_EDIT => RouteNames::USER_EDIT,
    ])->except(RouteConstants::RESOURCE_UPDATE);
    Route::post('/users/{user}', [UserController::class, 'update'])->name(RouteNames::USER_UPDATE);
});

/**
 * Маршрутизатор для табельщика
 */
Route::middleware([MiddlewareNames::AUTH_MIDDLEWARE, MiddlewareNames::TIME_KEEPER_MIDDLEWARE])->group(function () {
    Route::get('/time-keeper', [TimeKeeperController::class, 'dashboard'])->name(RouteNames::TIME_KEEPER_DASHBOARD);
});

/**
 * Маршрутизатор для бухгалтера
 */
Route::middleware([MiddlewareNames::AUTH_MIDDLEWARE, MiddlewareNames::ACCOUNTING_MIDDLEWARE])->group(function () {
    Route::get('/accounting', [AccountingController::class, 'dashboard'])->name(RouteNames::ACCOUNTING_DASHBOARD);
});
