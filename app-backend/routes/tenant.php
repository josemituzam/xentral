<?php

declare(strict_types=1);

use App\Http\Controllers\Core\AuthController;
use App\Http\Controllers\Core\User\UserController;
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
        'prefix' => 'api/v2'
    ], function () {
        Route::post('auth/login', [AuthController::class, 'loginInLandlord']);
        Route::group(['middleware' => ['jwt.verify']], function () {
            // Auth Routes
            Route::post('auth/logout',  [AuthController::class, 'logout']);
            // User Routes
            Route::get('user/auth/{id}', [UserController::class, 'show']);
            // Request Domains Routes
        });
    });
});
