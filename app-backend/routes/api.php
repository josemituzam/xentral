<?php

use App\Http\Controllers\Core\Api\ApiCloudfareController;
use App\Http\Controllers\Core\AuthController;
use App\Http\Controllers\Core\User\UserController;
use App\Http\Controllers\Landlord\RequestDomain\RequestDomainController;
use App\Http\Controllers\Landlord\Service\ServiceController;
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

Route::group([
    'prefix' => 'v1'
], function () {
    Route::post('auth/login', [AuthController::class, 'loginInLandlord']);
    Route::group(['middleware' => ['jwt.verify']], function () {
        //Prueba Cloudfare
        Route::post('domain/cloud', [ApiCloudfareController::class, 'createSubDomainDemo']);
        // Auth Routes
        Route::post('auth/logout',  [AuthController::class, 'logout']);
        // User Routes
        Route::get('user/auth/{id}', [UserController::class, 'show']);
        // Request Domains Routes
        Route::post('request-domain/store', [RequestDomainController::class, 'store']);
        Route::put('request-domain/{id}/update', [RequestDomainController::class, 'update']);
        Route::get('request-domain/index', [RequestDomainController::class, 'index']);
        Route::get('request-domain/{id}/edit', [RequestDomainController::class, 'edit']);
        Route::delete('request-domain/{id}', [RequestDomainController::class, 'destroy']);
        Route::put('request-domain/active/{id}', [RequestDomainController::class, 'activeRecord']);
        Route::put('request-domain/approved/{id}', [RequestDomainController::class, 'approvedRecord']);
        // Servicio
        Route::post('service/store', [ServiceController::class, 'store']);
        Route::put('service/{id}/update', [ServiceController::class, 'update']);
        Route::get('service/index', [ServiceController::class, 'index']);
        Route::get('service/{id}/edit', [ServiceController::class, 'edit']);
        Route::delete('service/{id}', [ServiceController::class, 'destroy']);
        Route::put('service/active/{id}', [ServiceController::class, 'activeRecord']);
    });
});
