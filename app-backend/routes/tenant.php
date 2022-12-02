<?php

declare(strict_types=1);

use App\Http\Controllers\Core\AuthController;
use App\Http\Controllers\Core\User\UserController;
use App\Http\Controllers\Tenant\Isp\Commercial\Contract\IspContractController;
use App\Http\Controllers\Tenant\Isp\Commercial\Customer\IspContactCustomerController;
use App\Http\Controllers\Tenant\Isp\Commercial\Customer\IspCustomerController;
use App\Http\Controllers\Tenant\Isp\Commercial\Plan\IspLastMilesController;
use App\Http\Controllers\Tenant\Isp\Commercial\Plan\IspPlanController;
use App\Http\Controllers\Tenant\Isp\Commercial\Sector\IspSectorController;
use App\Http\Controllers\Tenant\Note\NoteController;
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
        'prefix' => 'v1/client'
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
            Route::post('ispcustomer/documents', [IspCustomerController::class, 'storeDocument']);

            Route::post('ispcustomer/contact/store', [IspContactCustomerController::class, 'store']);
            Route::get('ispcustomer/contact/{id}/edit', [IspContactCustomerController::class, 'edit']);

            //Planes
            Route::get('ispplan/index', [IspPlanController::class, 'index']);
            Route::get('ispplan/lastmiles/index', [IspLastMilesController::class, 'index']);
            Route::post('ispplan/store', [IspPlanController::class, 'store']);
            Route::get('ispplan/{id}/edit', [IspPlanController::class, 'edit']);
            Route::put('ispplan/{id}/update', [IspPlanController::class, 'update']);
            Route::delete('ispplan/{id}', [IspPlanController::class, 'destroy']);
            Route::put('ispplan/active/{id}', [IspPlanController::class, 'activeRecord']);
            Route::get('ispplan/minimunpermanences', [IspPlanController::class, 'getMinimunPermanences']);

            //Sectores
            Route::get('ispsector/index', [IspSectorController::class, 'index']);
            Route::post('ispsector/store', [IspSectorController::class, 'store']);
            Route::get('ispsector/{id}/edit', [IspSectorController::class, 'edit']);
            Route::put('ispsector/{id}/update', [IspSectorController::class, 'update']);
            Route::put('ispsector/active/{id}', [IspSectorController::class, 'activeRecord']);
            Route::get('ispsector/country', [IspSectorController::class, 'getCountry']);
            Route::get('ispsector/{city_id}/location', [IspSectorController::class, 'getLocation']);

            //Contratos
            Route::get('ispcontract/index', [IspContractController::class, 'index']);
            Route::post('ispcontract/store', [IspContractController::class, 'store']);
            Route::get('ispcontract/{id}/edit', [IspContractController::class, 'edit']);
            Route::put('ispcontract/{id}/update', [IspContractController::class, 'update']);
            Route::put('ispcontract/active/{id}', [IspContractController::class, 'activeRecord']);
            Route::get('ispcontract/customer', [IspContractController::class, 'getCustomer']);
            Route::get('ispcontract/payment', [IspContractController::class, 'getPayment']);
            Route::get('ispcontract/plan/{last_mile_id}', [IspContractController::class, 'getPlan']);
            Route::get('ispcontract/sector', [IspContractController::class, 'getSector']);
            Route::get('ispcontract/templates/contract', [IspContractController::class, 'getTemplateContract']);
            Route::get('ispcontract/anotherprovider', [IspContractController::class, 'getAnotherProvider']);

            //Notas
            Route::get('note/index', [NoteController::class, 'index']);
            Route::post('note/store', [NoteController::class, 'store']);
            Route::put('note/{id}/update', [NoteController::class, 'update']);
        });
    });
});
