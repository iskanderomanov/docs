<?php

use App\Http\Controllers\Web\Accounting\AccountingController;
use App\Http\Controllers\Web\Auth\AuthController;
use App\Http\Controllers\Web\Hr\DepartmentController;
use App\Http\Controllers\Web\Hr\HrController;
use App\Http\Controllers\Web\Hr\PositionController;
use App\Http\Controllers\Web\Hr\UserController;
use App\Http\Controllers\Web\TimeKeeper\ReportCardController;
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
Route::prefix('hr')->middleware([MiddlewareNames::AUTH_MIDDLEWARE, MiddlewareNames::HR_MIDDLEWARE])->group(function () {
    Route::get('/', [HrController::class, 'dashboard'])->name(RouteNames::HR_DASHBOARD);
    Route::resource('/positions', PositionController::class)->names([
        RouteConstants::RESOURCE_INDEX => RouteNames::POSITION_INDEX,
        RouteConstants::RESOURCE_CREATE => RouteNames::POSITION_CREATE,
        RouteConstants::RESOURCE_STORE => RouteNames::POSITION_STORE,
        RouteConstants::RESOURCE_SHOW => RouteNames::POSITION_SHOW,
        RouteConstants::RESOURCE_EDIT => RouteNames::POSITION_EDIT,
    ])->except(RouteConstants::RESOURCE_UPDATE);
    Route::post('/positions/{position}', [PositionController::class, 'update'])->name(RouteNames::POSITION_UPDATE);

    Route::resource('/departments', DepartmentController::class)->names([
        RouteConstants::RESOURCE_INDEX => RouteNames::DEPARTMENT_INDEX,
        RouteConstants::RESOURCE_CREATE => RouteNames::DEPARTMENT_CREATE,
        RouteConstants::RESOURCE_STORE => RouteNames::DEPARTMENT_STORE,
        RouteConstants::RESOURCE_SHOW => RouteNames::DEPARTMENT_SHOW,
        RouteConstants::RESOURCE_EDIT => RouteNames::DEPARTMENT_EDIT,
    ])->except(RouteConstants::RESOURCE_UPDATE);
    Route::post('/departments/{departments}', [DepartmentController::class, 'update'])->name(RouteNames::DEPARTMENT_UPDATE);

    Route::resource('/users', UserController::class)->names([
        RouteConstants::RESOURCE_INDEX => RouteNames::USER_INDEX,
        RouteConstants::RESOURCE_CREATE => RouteNames::USER_CREATE,
        RouteConstants::RESOURCE_STORE => RouteNames::USER_STORE,
        RouteConstants::RESOURCE_EDIT => RouteNames::USER_EDIT,
    ])->except(RouteConstants::RESOURCE_UPDATE);
    Route::post('/users/{user}', [UserController::class, 'update'])->name(RouteNames::USER_UPDATE);
    Route::get('/report_cards', [\App\Http\Controllers\Web\Hr\ReportCardController::class,'index'])->name(RouteNames::HR_REPORT_CARDS_INDEX);
    Route::get('/report_cards/{id}', [\App\Http\Controllers\Web\Hr\ReportCardController::class,'show'])->name(RouteNames::HR_REPORT_CARDS_SHOW);
    Route::post('/report_cards/{id}', [\App\Http\Controllers\Web\Hr\ReportCardController::class,'update'])->name(RouteNames::HR_REPORT_CARDS_UPDATE);

});

/**
 * Маршрутизатор для табельщика
 */
Route::prefix('time-keeper')->middleware([MiddlewareNames::AUTH_MIDDLEWARE, MiddlewareNames::TIME_KEEPER_MIDDLEWARE])->group(function () {
    Route::get('/time-keeper', [TimeKeeperController::class, 'dashboard'])->name(RouteNames::TIME_KEEPER_DASHBOARD);
    Route::get('/report-cards/', [ReportCardController::class, 'index'])->name(RouteNames::REPORT_CARDS_INDEX);
    Route::get('/report-cards/edit/{id}', [ReportCardController::class, 'edit'])->name(RouteNames::REPORT_CARDS_EDIT);
    Route::get('/report-cards/create', [ReportCardController::class, 'create'])->name(RouteNames::REPORT_CARDS_CREATE);
    Route::post('/report-cards/store', [ReportCardController::class, 'store'])->name(RouteNames::REPORT_CARDS_STORE);
    Route::post('/report-cards/update/{id}', [ReportCardController::class, 'update'])->name(RouteNames::REPORT_CARDS_UPDATE);
});

/**
 * Маршрутизатор для бухгалтера
 */
Route::prefix('accounting')->middleware([MiddlewareNames::AUTH_MIDDLEWARE, MiddlewareNames::ACCOUNTING_MIDDLEWARE])->group(function () {
    Route::get('/accounting', [AccountingController::class, 'dashboard'])->name(RouteNames::ACCOUNTING_DASHBOARD);
    Route::get('/report_cards', [\App\Http\Controllers\Web\Accounting\ReportCartController::class,'index'])->name(RouteNames::A_REPORT_CARDS_INDEX);
    Route::get('/report_cards/{id}', [\App\Http\Controllers\Web\Accounting\ReportCartController::class,'show'])->name(RouteNames::A_REPORT_CARDS_SHOW);
    Route::post('/report_cards/{id}', [\App\Http\Controllers\Web\Accounting\ReportCartController::class,'update'])->name(RouteNames::A_REPORT_CARDS_UPDATE);

});


Route::get('/save-report/{id}',[\App\Http\Controllers\Web\Accounting\ReportCartController::class,'savePdf'])
    ->middleware('auth')
    ->name('save_pdf');
