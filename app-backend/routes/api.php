<?php

use App\Http\Controllers\Core\Auth\AuthController;
use App\Http\Controllers\Core\Auth\Landlord\Role\RoleController;
use App\Http\Controllers\Core\Auth\Landlord\User\UserController;
use App\Http\Controllers\Landlord\Company\CompanyController;
use App\Http\Controllers\Landlord\Coupon\CouponController;
use App\Http\Controllers\Landlord\Plan\PlanController;
use App\Http\Controllers\Landlord\RequestDomain\RequestDomainController;
use App\Http\Controllers\Landlord\Setting\SettingController;
use App\Http\Controllers\Landlord\ThemeLayout\ThemeLayoutController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('auth/login', [AuthController::class, 'landlordLogin']);

Route::group(['middleware' => ['jwt.verify']], function () {
    // Request Domains Routes
    Route::post('/request-domain/store', [RequestDomainController::class, 'store']);
    Route::put('/request-domain/{id}/update', [RequestDomainController::class, 'update']);
    Route::get('/request-domain/index', [RequestDomainController::class, 'index']);
    Route::get('/request-domain/{id}/edit', [RequestDomainController::class, 'edit']);
    Route::delete('/request-domain/{id}', [RequestDomainController::class, 'destroy']);
});

