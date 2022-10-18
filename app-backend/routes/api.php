<?php


use App\Http\Controllers\Core\AuthController;
use App\Http\Controllers\Core\User\UserController;
use App\Http\Controllers\Landlord\RequestDomain\RequestDomainController;
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
    });
});
