<?php

declare(strict_types=1);

use App\Http\Controllers\Core\AuthController;
use App\Http\Controllers\Core\User\UserController;
use App\Http\Controllers\Tenant\Customer\IspCustomerController;
use App\Http\Controllers\Tenant\Service\ServiceController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'apiTenant',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {

    Route::group([
        'prefix' => 'api/v1/client'
    ], function () {
        Route::post('auth/login', [AuthController::class, 'loginInTenant']);
        Route::group(['middleware' => ['jwt.verify']], function () {
            // Auth Routes
            Route::post('auth/logout',  [AuthController::class, 'logout']);
            // User Routes
            Route::get('user/auth/{id}', [UserController::class, 'show']);
            // Servicio
            Route::get('service/index', [ServiceController::class, 'index']);

            //Cliente
            Route::post('ispcustomer/store', [IspCustomerController::class, 'store']);
            Route::put('ispcustomer/{id}/update', [IspCustomerController::class, 'update']);
            Route::get('ispcustomer/index', [IspCustomerController::class, 'index']);
            Route::get('ispcustomer/{id}/edit', [IspCustomerController::class, 'edit']);
            Route::delete('ispcustomer/{id}', [IspCustomerController::class, 'destroy']);
            Route::put('ispcustomer/active/{id}', [IspCustomerController::class, 'activeRecord']);
        });
    });
});
